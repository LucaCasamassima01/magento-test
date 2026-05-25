<?php

namespace Codestorm\ProductNotes\Model;

use Magento\Framework\Model\AbstractModel;
use Codestorm\ProductNotes\Api\Data\ProductNoteInterface;

class ProductNote extends AbstractModel implements ProductNoteInterface
{
    protected function _construct(): void
    {
        $this->_init(
            \Codestorm\ProductNotes\Model\ResourceModel\ProductNote::class
        );
    }

    public function getId(): ?int
    {
        $id = $this->getData(self::NOTE_ID);

        return $id !== null ? (int)$id : null;
    }

    public function setId($id)
    {
        return $this->setData(self::NOTE_ID, $id);
    }

    public function getCustomerId(): int
    {
        return (int)$this->getData(self::CUSTOMER_ID);
    }

    public function setCustomerId($id)
    {
        return $this->setData(self::CUSTOMER_ID, $id);
    }

    public function getProductId(): int
    {
        return (int)$this->getData(self::PRODUCT_ID);
    }

    public function setProductId($id)
    {
        return $this->setData(self::PRODUCT_ID, $id);
    }

    public function getContent(): string
    {
        return (string)$this->getData(self::CONTENT);
    }

    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }
}