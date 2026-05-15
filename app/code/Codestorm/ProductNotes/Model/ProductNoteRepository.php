<?php
namespace Codestorm\ProductNotes\Model;

use Codestorm\ProductNotes\Api\ProductNoteRepositoryInterface;
use Codestorm\ProductNotes\Api\Data\ProductNoteInterface;

class ProductNoteRepository implements ProductNoteRepositoryInterface
{
    private $resource;

    public function __construct(
        \Codestorm\ProductNotes\Model\ResourceModel\ProductNote $resource
    ) {
        $this->resource = $resource;
    }

    public function save(ProductNoteInterface $note)
    {
        $this->resource->save($note);
        return $note;
    }
}