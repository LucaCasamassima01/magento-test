<?php

namespace Codestorm\ProductNotes\Model\ResourceModel\ProductNote;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Codestorm\ProductNotes\Model\ProductNote::class,
            \Codestorm\ProductNotes\Model\ResourceModel\ProductNote::class
        );
    }
}