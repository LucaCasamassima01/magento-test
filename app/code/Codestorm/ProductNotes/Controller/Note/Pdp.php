<?php

namespace Codestorm\ProductNotes\Controller\Note;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\Result\JsonFactory;
use Codestorm\ProductNotes\Model\ResourceModel\ProductNote\CollectionFactory;

class Pdp extends Action
{
    private Session $customerSession;
    private JsonFactory $jsonFactory;
    private CollectionFactory $collectionFactory;

    public function __construct(
        Context $context,
        Session $customerSession,
        JsonFactory $jsonFactory,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->jsonFactory = $jsonFactory;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {
        $result = $this->jsonFactory->create();

        if (!$this->customerSession->isLoggedIn()) {
            return $result->setData([
                'html' => ''
            ]);
        }

        $productId = (int)$this->getRequest()->getParam('product_id');

        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('customer_id', $this->customerSession->getCustomerId());
        $collection->addFieldToFilter('product_id', $productId);

        $note = $collection->getFirstItem();

        return $result->setData([
            'note' => [
                'id' => $note->getId(),
                'content' => $note->getContent()
            ]
        ]);
    }
}