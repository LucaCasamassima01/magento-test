<?php

declare(strict_types=1);

namespace Codestorm\FakePim\Api\Data;

interface ProductResponseInterface
{
    public const ID = 'id';
    public const SKU = 'sku';
    public const NAME = 'name';
    public const PRICE = 'price';
    public const SPECIAL_PRICE = 'special_price';
    public const STOCK_QTY = 'stock_qty';
    public const PIM_UPDATED_AT = 'pim_updated_at';

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): self;

    /**
     * @return string
     */
    public function getSku(): string;

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku(string $sku): self;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice(float $price): self;

    /**
     * @return float|null
     */
    public function getSpecialPrice(): ?float;

    /**
     * @param float|null $specialPrice
     * @return $this
     */
    public function setSpecialPrice(?float $specialPrice): self;

    /**
     * @return float
     */
    public function getStockQty(): float;

    /**
     * @param float $qty
     * @return $this
     */
    public function setStockQty(float $qty): self;

    /**
     * @return string|null
     */
    public function getPimUpdatedAt(): ?string;

    /**
     * @param string|null $date
     * @return $this
     */
    public function setPimUpdatedAt(?string $date): self;
}