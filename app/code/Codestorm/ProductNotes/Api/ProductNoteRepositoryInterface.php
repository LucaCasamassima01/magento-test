<?php

namespace Codestorm\ProductNotes\Api;

use Codestorm\ProductNotes\Api\Data\ProductNoteInterface;

interface ProductNoteRepositoryInterface
{
    public function save(ProductNoteInterface $note);
}