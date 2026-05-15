<?php

namespace Codestorm\ProductNotes\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductNote extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('codestorm_product_note', 'note_id');
    }
}