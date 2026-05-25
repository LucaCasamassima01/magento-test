<?php

namespace Codestorm\ProductNotes\Block\Note;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Codestorm\ProductNotes\Api\ProductNoteRepositoryInterface;

class Edit extends Template
{
    private ProductNoteRepositoryInterface $repository;
    private Registry $registry;

    public function __construct(
        Template\Context $context,
        ProductNoteRepositoryInterface $repository,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->repository = $repository;
        $this->registry = $registry;
    }

    public function getNote()
    {
        $id = (int)$this->getRequest()->getParam('id');
        return $this->repository->getById($id);
    }
}