<?php

namespace Codestorm\ProductNotes\Block\Note;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session as CustomerSession;
use Codestorm\ProductNotes\Model\ResourceModel\ProductNote\Collection;

class Listing extends Template
{
    private $customerSession;
    private $collection;

    public function __construct(
        Template\Context $context,
        CustomerSession $customerSession,
        Collection $collection,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
        $this->collection = $collection;
    }

    public function getNotes()
    {
        $customerId = (int) $this->customerSession->getCustomerId();

        return $this->collection
            ->addFieldToFilter('customer_id', $customerId)
            ->setOrder('note_id', 'DESC');
    }
}