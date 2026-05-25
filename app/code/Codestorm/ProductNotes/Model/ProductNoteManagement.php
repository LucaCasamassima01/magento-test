<?php

namespace Codestorm\ProductNotes\Model;

use Codestorm\ProductNotes\Api\Data\ProductNoteInterface;
use Codestorm\ProductNotes\Api\ProductNoteManagementInterface;
use Codestorm\ProductNotes\Api\ProductNoteRepositoryInterface;
use Codestorm\ProductNotes\Model\ResourceModel\ProductNote\CollectionFactory;
use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\Exception\AuthorizationException;

class ProductNoteManagement implements ProductNoteManagementInterface
{
    private $repository;

    private $productNoteFactory;

    private $collectionFactory;

    private $userContext;

    public function __construct(
        ProductNoteRepositoryInterface $repository,
        ProductNoteFactory $productNoteFactory,
        CollectionFactory $collectionFactory,
        UserContextInterface $userContext
    ) {
        $this->repository = $repository;
        $this->productNoteFactory = $productNoteFactory;
        $this->collectionFactory = $collectionFactory;
        $this->userContext = $userContext;
    }

    /**
     * Get current customer ID
     */
    private function getCustomerId()
    {
        return (int)$this->userContext->getUserId();
    }

    /**
     * Validate ownership
     */
    private function validateOwnership(
        ProductNoteInterface $note
    ) {
        if ((int)$note->getCustomerId() !== $this->getCustomerId()) {
            throw new AuthorizationException(
                __('You are not allowed to access this note.')
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getById($noteId)
    {
        $note = $this->repository->getById($noteId);

        $this->validateOwnership($note);

        return $note;
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerNotes()
    {
        $collection = $this->collectionFactory->create();

        $collection->addFieldToFilter(
            'customer_id',
            $this->getCustomerId()
        );

        return $collection->getItems();
    }

    /**
     * {@inheritdoc}
     */
    public function create($productId, $content)
    {
        $note = $this->productNoteFactory->create();

        $note->setCustomerId($this->getCustomerId());
        $note->setProductId($productId);
        $note->setContent($content);

        return $this->repository->save($note);
    }

    /**
     * {@inheritdoc}
     */
    public function update($noteId, $content)
    {
        $note = $this->repository->getById($noteId);

        $this->validateOwnership($note);

        $note->setContent($content);

        return $this->repository->save($note);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($noteId)
    {
        $note = $this->repository->getById($noteId);

        $this->validateOwnership($note);

        return $this->repository->delete($note);
    }
}