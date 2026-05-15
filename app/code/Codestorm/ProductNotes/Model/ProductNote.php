<?php

namespace Codestorm\ProductNotes\Model;

use Magento\Framework\Model\AbstractModel;
use Codestorm\ProductNotes\Api\Data\ProductNoteInterface;

class ProductNote extends AbstractModel implements ProductNoteInterface
{
    protected function _construct()
    {
        $this->_init(\Codestorm\ProductNotes\Model\ResourceModel\ProductNote::class);
    }

    public function getId()
    {
        return $this->getData(self::NOTE_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::NOTE_ID, $id);
    }

    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    public function setCustomerId($id)
    {
        return $this->setData(self::CUSTOMER_ID, $id);
    }

    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    public function setProductId($id)
    {
        return $this->setData(self::PRODUCT_ID, $id);
    }

    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }
}