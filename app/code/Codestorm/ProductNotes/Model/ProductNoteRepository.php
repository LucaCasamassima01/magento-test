<?php

namespace Codestorm\ProductNotes\Model;

use Codestorm\ProductNotes\Api\Data\ProductNoteInterface;
use Codestorm\ProductNotes\Api\ProductNoteRepositoryInterface;
use Codestorm\ProductNotes\Model\ResourceModel\ProductNote as ProductNoteResource;
use Magento\Framework\Exception\NoSuchEntityException;

class ProductNoteRepository implements ProductNoteRepositoryInterface
{
    private ProductNoteResource $resource;

    private ProductNoteFactory $productNoteFactory;

    public function __construct(
        ProductNoteResource $resource,
        ProductNoteFactory $productNoteFactory
    ) {
        $this->resource = $resource;
        $this->productNoteFactory = $productNoteFactory;
    }

    public function save(
        ProductNoteInterface $note
    ): ProductNoteInterface {
        $this->resource->save($note);

        return $note;
    }

    public function getById(
        int $noteId
    ): ProductNoteInterface {
        $note = $this->productNoteFactory->create();

        $this->resource->load($note, $noteId);

        if (!$note->getId()) {
            throw new NoSuchEntityException(
                __('Note with ID "%1" does not exist.', $noteId)
            );
        }

        return $note;
    }

    public function delete(
        ProductNoteInterface $note
    ): bool {
        $this->resource->delete($note);

        return true;
    }
}