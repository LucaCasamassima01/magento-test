<?php

namespace Codestorm\ProductNotes\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Codestorm\ProductNotes\Api\ProductNoteManagementInterface;

class GetNoteById implements ResolverInterface
{
    public function __construct(
        private ProductNoteManagementInterface $management
    ) {}

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        ?array $value = null,
        ?array $args = null
    ) {
        return $this->management->getById(
            (int)$args['noteId']
        );
    }
}