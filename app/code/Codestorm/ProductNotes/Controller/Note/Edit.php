<?php

namespace Codestorm\ProductNotes\Controller\Note;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Codestorm\ProductNotes\Api\ProductNoteRepositoryInterface;
use Magento\Authorization\Model\UserContextInterface;

class Edit extends Action
{
    private PageFactory $pageFactory;
    private ProductNoteRepositoryInterface $repository;
    private UserContextInterface $userContext;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        ProductNoteRepositoryInterface $repository,
        UserContextInterface $userContext
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->repository = $repository;
        $this->userContext = $userContext;
    }

    public function execute()
    {
        $noteId = (int)$this->getRequest()->getParam('id');

        try {
            $note = $this->repository->getById($noteId);

            // check user
            if ((int)$note->getCustomerId() !== (int)$this->userContext->getUserId()) {
                throw new NoSuchEntityException(__('Not allowed'));
            }

        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__('Note not found or not allowed'));
            return $this->_redirect('*/*/index');
        }

        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Edit Note'));

        return $resultPage;
    }
}