<?php

namespace Codestorm\ProductNotes\Controller\Note;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session as CustomerSession;
use Codestorm\ProductNotes\Api\ProductNoteRepositoryInterface;

class Delete extends Action
{
    private CustomerSession $customerSession;
    private ProductNoteRepositoryInterface $repository;

    public function __construct(
        Context $context,
        CustomerSession $customerSession,
        ProductNoteRepositoryInterface $repository
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->repository = $repository;
    }

    public function execute()
    {
        if (!$this->customerSession->isLoggedIn()) {
            return $this->_redirect('customer/account/login');
        }

        $noteId = (int)$this->getRequest()->getParam('id');

        if (!$noteId) {
            $this->messageManager->addErrorMessage(__('Invalid note ID'));
            return $this->_redirect('*/*/index');
        }

        try {
            $note = $this->repository->getById($noteId);

            if ((int)$note->getCustomerId() !== (int)$this->customerSession->getCustomerId()) {
                throw new \Exception(__('You are not allowed to delete this note.'));
            }

            $this->repository->delete($note);

            $this->messageManager->addSuccessMessage(__('Note deleted successfully'));

        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $this->_redirect('*/*/index');
    }
}