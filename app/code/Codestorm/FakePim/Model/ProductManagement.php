<?php

declare(strict_types=1);

namespace Codestorm\FakePim\Model;

use Codestorm\FakePim\Api\ProductManagementInterface;
use Codestorm\FakePim\Api\Data\ProductResponseInterface;
use Codestorm\FakePim\Model\Data\ProductResponseFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\CatalogInventory\Api\StockItemRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class ProductManagement implements ProductManagementInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private StockItemRepositoryInterface $stockItemRepository,
        private ProductResponseFactory $productResponseFactory,
        private ProductFactory $productFactory
    ) {
    }

    // -------------------------
    // GET PRODUCT
    // -------------------------
    public function get(string $sku): ProductResponseInterface
    {
        $product = $this->productRepository->get($sku);

        $stockItem = $this->stockItemRepository->get($product->getId());

        $pimUpdatedAt = $product->getCustomAttribute('pim_updated_at');
        $specialPrice = $product->getData('special_price');

        return $this->buildResponse(
            $product,
            $stockItem->getQty(),
            $pimUpdatedAt ? $pimUpdatedAt->getValue() : null,
            $specialPrice !== null ? (float)$specialPrice : null
        );
    }

    // -------------------------
    // UPSERT PRODUCT
    // -------------------------
    public function upsert(string $sku, string $name): ProductResponseInterface
    {
        $isNew = false;

        try {
            $product = $this->productRepository->get($sku);
        } catch (NoSuchEntityException $e) {
            $product = $this->productFactory->create();
            $isNew = true;
        }

        if ($isNew) {
            $product->setSku($sku);
            $product->setTypeId('simple');
            // $product->setAttributeSetId(4);
            // retrieve default WebsiteId
            $product->setWebsiteIds([1]);

            $product->setStatus(Status::STATUS_DISABLED);
            $product->setVisibility(Visibility::VISIBILITY_NOT_VISIBLE);
            $product->setPrice(0);
        }

        $product->setName($name);

        $product->setCustomAttribute(
            'pim_updated_at',
            (new \DateTime())->format('Y-m-d H:i:s')
        );

        $this->productRepository->save($product);

        $stockItem = $this->stockItemRepository->get($product->getId());

        return $this->buildResponse(
            $product,
            $stockItem->getQty(),
            $product->getCustomAttribute('pim_updated_at')->getValue(),
            $product->getData('special_price') !== null ? (float)$product->getData('special_price') : null
        );
    }

    // -------------------------
    // UPDATE PRICE
    // -------------------------
    public function updatePrice(
        string $sku,
        float $price,
        ?float $specialPrice = null
    ): ProductResponseInterface {
        try {
            $product = $this->productRepository->get($sku);
        } catch (NoSuchEntityException $e) {
            throw new NoSuchEntityException(
                __("The product with SKU \"%1\" does not exist.", $sku)
            );
        }

        $product->setPrice($price);
        $product->setData('special_price', $specialPrice);

        $product->setCustomAttribute(
            'pim_updated_at',
            (new \DateTime())->format('Y-m-d H:i:s')
        );

        $this->productRepository->save($product);

        $stockItem = $this->stockItemRepository->get($product->getId());

        return $this->buildResponse(
            $product,
            $stockItem->getQty(),
            $product->getCustomAttribute('pim_updated_at')->getValue(),
            $specialPrice
        );
    }

    // -------------------------
    // UPDATE STOCK (TASK 5)
    // -------------------------
    public function updateStock(string $sku, float $stockQty): ProductResponseInterface
    {
        try {
            $product = $this->productRepository->get($sku);
        } catch (NoSuchEntityException $e) {
            throw new NoSuchEntityException(
                __("The product with SKU \"%1\" does not exist.", $sku)
            );
        }

        $stockItem = $this->stockItemRepository->get($product->getId());

        $stockItem->setQty($stockQty);
        $stockItem->setIsInStock($stockQty > 0);

        $this->stockItemRepository->save($stockItem);

        $product->setCustomAttribute(
            'pim_updated_at',
            (new \DateTime())->format('Y-m-d H:i:s')
        );

        $this->productRepository->save($product);

        return $this->buildResponse(
            $product,
            $stockQty,
            $product->getCustomAttribute('pim_updated_at')->getValue(),
            $product->getData('special_price') !== null ? (float)$product->getData('special_price') : null
        );
    }

    // -------------------------
    // CENTRAL RESPONSE BUILDER
    // -------------------------
    private function buildResponse(
        $product,
        float $stockQty,
        ?string $pimUpdatedAt,
        ?float $specialPrice
    ): ProductResponseInterface {
        return $this->productResponseFactory->create()
            ->setId((int)$product->getId())
            ->setSku($product->getSku())
            ->setName($product->getName())
            ->setPrice((float)$product->getPrice())
            ->setSpecialPrice($specialPrice)
            ->setStockQty($stockQty)
            ->setPimUpdatedAt($pimUpdatedAt);
    }
}