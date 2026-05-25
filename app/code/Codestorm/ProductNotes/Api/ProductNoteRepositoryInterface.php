<?php

namespace Codestorm\ProductNotes\Api;

use Codestorm\ProductNotes\Api\Data\ProductNoteInterface;

interface ProductNoteRepositoryInterface
{
    /**
     * Save note
     */
    public function save(
        ProductNoteInterface $note
    ): ProductNoteInterface;

    /**
     * Get note by ID
     */
    public function getById(
        int $noteId
    ): ProductNoteInterface;

    /**
     * Delete note
     */
    public function delete(
        ProductNoteInterface $note
    ): bool;
}