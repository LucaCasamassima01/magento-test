<?php

declare(strict_types=1);

namespace Codestorm\FakePim\Model\Data;

use Codestorm\FakePim\Api\Data\ProductResponseInterface;
use Magento\Framework\DataObject;

class ProductResponse extends DataObject implements ProductResponseInterface
{
    public function getId(): int
    {
        return (int)$this->getData(self::ID);
    }

    public function setId(int $id): ProductResponseInterface
    {
        return $this->setData(self::ID, $id);
    }

    public function getSku(): string
    {
        return (string)$this->getData(self::SKU);
    }

    public function setSku(string $sku): ProductResponseInterface
    {
        return $this->setData(self::SKU, $sku);
    }

    public function getName(): string
    {
        return (string)$this->getData(self::NAME);
    }

    public function setName(string $name): ProductResponseInterface
    {
        return $this->setData(self::NAME, $name);
    }

    public function getPrice(): float
    {
        return (float)$this->getData(self::PRICE);
    }

    public function setPrice(float $price): ProductResponseInterface
    {
        return $this->setData(self::PRICE, $price);
    }

    public function getSpecialPrice(): ?float
    {
        $value = $this->getData(self::SPECIAL_PRICE);

        return $value !== null ? (float)$value : null;
    }

    public function setSpecialPrice(?float $specialPrice): ProductResponseInterface
    {
        return $this->setData(self::SPECIAL_PRICE, $specialPrice);
    }

    public function getStockQty(): float
    {
        return (float)$this->getData(self::STOCK_QTY);
    }

    public function setStockQty(float $qty): ProductResponseInterface
    {
        return $this->setData(self::STOCK_QTY, $qty);
    }

    public function getPimUpdatedAt(): ?string
    {
        return $this->getData(self::PIM_UPDATED_AT);
    }

    public function setPimUpdatedAt(?string $date): ProductResponseInterface
    {
        return $this->setData(self::PIM_UPDATED_AT, $date);
    }
}