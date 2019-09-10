<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationAjax\Blocks;

use Magento\Framework\View\Element\Template;
use Manadev\LayeredNavigationAjax\Configuration;

class Apply extends Template
{
    /**
     * @var Configuration
     */
    protected $configuration;

    public function __construct(Template\Context $context, Configuration $configuration, array $data = []) {
        parent::__construct($context, $data);
        $this->configuration = $configuration;
    }

    public function toHtml() {
        return '';
    }

    public function getHtml() {
        if ($this->configuration->getFilterApplyMode() != 'after_pressing_apply_button') {
            return '';
        }
        return parent::toHtml();
    }
}