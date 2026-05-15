<?php
namespace Codestorm\ProductNotes\Api\Data;

interface ProductNoteInterface
{
    const NOTE_ID = 'note_id';
    const CUSTOMER_ID = 'customer_id';
    const PRODUCT_ID = 'product_id';
    const CONTENT = 'content';

    public function getId();
    public function setId($id);

    public function getCustomerId();
    public function setCustomerId($id);

    public function getProductId();
    public function setProductId($id);

    public function getContent();
    public function setContent($content);
}