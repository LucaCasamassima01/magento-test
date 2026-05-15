<?php

namespace Codestorm\ProductNotes\Block\Product;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Registry;

class Note extends Template
{
    private $customerSession;
    private $scopeConfig;
    private $registry;

    public function __construct(
    Template\Context $context,
    CustomerSession $customerSession,
    ScopeConfigInterface $scopeConfig,
    Registry $registry,
    array $data = []
) {
    parent::__construct($context, $data);
    $this->customerSession = $customerSession;
    $this->scopeConfig = $scopeConfig;
    $this->registry = $registry;
}

    public function isEnabled(): bool
    {
        return (bool) $this->scopeConfig->getValue(
            'product_notes/general/enabled'
        );
    }

    public function isCustomerLoggedIn(): bool
    {
        return $this->customerSession->isLoggedIn();
    }

    public function getProduct()
    {
        return $this->registry->registry('current_product');
    }

    public function isSkuExcluded(): bool
    {
        $product = $this->getProduct();

        if (!$product) {
            return false;
        }

        $excluded = $this->scopeConfig->getValue(
            'product_notes/general/excluded_skus'
        );

        if (!$excluded) {
            return false;
        }

        $excludedArray = array_filter(array_map('trim', explode(',', $excluded)));

        return in_array($product->getSku(), $excludedArray, true);
    }

    public function canShow(): bool
    {
        return $this->isEnabled()
            && $this->isCustomerLoggedIn()
            && !$this->isSkuExcluded();
    }
}