<?php

namespace Codestorm\ProductNotes\Controller\Note;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session as CustomerSession;
use Codestorm\ProductNotes\Api\ProductNoteRepositoryInterface;
use Codestorm\ProductNotes\Model\ProductNoteFactory;

class Save extends Action
{
    private $customerSession;
    private $repository;
    private $noteFactory;

    public function __construct(
    Context $context,
    CustomerSession $customerSession,
    ProductNoteRepositoryInterface $repository,
    ProductNoteFactory $noteFactory
) {
    parent::__construct($context);
    $this->customerSession = $customerSession;
    $this->repository = $repository;
    $this->noteFactory = $noteFactory;
}

    public function execute()
    {
        if (!$this->customerSession->isLoggedIn()) {
            return $this->_redirect('customer/account/login');
        }

        $productId = (int)$this->getRequest()->getParam('product_id');
        $content = trim($this->getRequest()->getParam('content'));

        if (!$productId || !$content) {
            $this->messageManager->addErrorMessage(__('Invalid data'));
            return $this->_redirect('/');
        }

        $note = $this->noteFactory->create();
        $note->setCustomerId($this->customerSession->getCustomerId());
        $note->setProductId($productId);
        $note->setContent($content);

        $this->repository->save($note);

        $this->messageManager->addSuccessMessage(__('Note saved successfully'));

        return $this->_redirect('catalog/product/view', [
            'id' => $productId
        ]);
    }
}