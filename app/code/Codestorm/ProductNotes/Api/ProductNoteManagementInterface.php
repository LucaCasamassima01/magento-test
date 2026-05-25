<?php

namespace Codestorm\ProductNotes\Api;

use Codestorm\ProductNotes\Api\Data\ProductNoteInterface;

interface ProductNoteManagementInterface
{
    /**
     * Get note by ID
     *
     * @param int $noteId
     * @return \Codestorm\ProductNotes\Api\Data\ProductNoteInterface
     */
    public function getById($noteId);

    /**
     * Get customer notes
     *
     * @return \Codestorm\ProductNotes\Api\Data\ProductNoteInterface[]
     */
    public function getCustomerNotes();

    /**
     * Create note
     *
     * @param int $productId
     * @param string $content
     * @return \Codestorm\ProductNotes\Api\Data\ProductNoteInterface
     */
    public function create($productId, $content);

    /**
     * Update note
     *
     * @param int $noteId
     * @param string $content
     * @return \Codestorm\ProductNotes\Api\Data\ProductNoteInterface
     */
    public function update($noteId, $content);

    /**
     * Delete note
     *
     * @param int $noteId
     * @return bool
     */
    public function delete($noteId);
}