<?php

namespace Codestorm\ProductNotes\Controller\Note;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Customer\Model\Session as CustomerSession;

class Index extends Action
{
    

    public function __construct(
        Context $context,
        private PageFactory $pageFactory,
        private CustomerSession $customerSession
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->customerSession->isLoggedIn()) {
            /* @var \Magento\Framework\Controller\ResultInterface $resultRedirect */
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setPath('customer/account/login');
            return $resultRedirect;
        }

        return $this->pageFactory->create();
    }
}