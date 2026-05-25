<?php

namespace Codestorm\ProductNotes\Api\Data;

interface ProductNoteInterface
{
    public const NOTE_ID = 'note_id';
    public const CUSTOMER_ID = 'customer_id';
    public const PRODUCT_ID = 'product_id';
    public const CONTENT = 'content';

    /**
     * Get note id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set note id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get customer id
     *
     * @return int|null
     */
    public function getCustomerId();

    /**
     * Set customer id
     *
     * @param int $id
     * @return $this
     */
    public function setCustomerId($id);

    /**
     * Get product id
     *
     * @return int|null
     */
    public function getProductId();

    /**
     * Set product id
     *
     * @param int $id
     * @return $this
     */
    public function setProductId($id);

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Set content
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content);
}