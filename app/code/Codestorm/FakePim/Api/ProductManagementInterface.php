<?php

declare(strict_types=1);

namespace Codestorm\FakePim\Api;

use Codestorm\FakePim\Api\Data\ProductResponseInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface ProductManagementInterface
{
    /**
     * Get product by SKU
     *
     * @param string $sku
     * @return \Codestorm\FakePim\Api\Data\ProductResponseInterface
     * @throws NoSuchEntityException
     */
    public function get(string $sku): ProductResponseInterface;
    

    /**
     * Create or update product by SKU
     *
     * @param string $sku
     * @param string $name
     * @return \Codestorm\FakePim\Api\Data\ProductResponseInterface
     */
    public function upsert(string $sku, string $name): ProductResponseInterface;

    /**
     * Update product price
     *
     * @param string $sku
     * @param float $price
     * @param float|null $specialPrice
     * @return \Codestorm\FakePim\Api\Data\ProductResponseInterface
     */
    public function updatePrice(
        string $sku,
        float $price,
        ?float $specialPrice = null
    ): ProductResponseInterface;

    /**
     * Update product stock
     *
     * @param string $sku
     * @param float $stockQty
     * @return \Codestorm\FakePim\Api\Data\ProductResponseInterface
     */
    public function updateStock(
        string $sku,
        float $stockQty
    ): ProductResponseInterface;
}