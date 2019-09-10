<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationAjax\Plugins;

use Magento\Framework\View\Element\AbstractBlock;
use Manadev\Core\Features;
use Manadev\LayeredNavigationAjax\Helper;

class AbstractBlockPlugin
{
    /**
     * @var Features
     */
    protected $features;
    /**
     * @var Helper
     */
    protected $helper;

    public function __construct(Features $features, Helper $helper) {
        $this->features = $features;
        $this->helper = $helper;
    }

    public function afterToHtml(AbstractBlock $block, $result) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $result;
        }

        if (!$blockNames = $this->helper->getAjaxRefreshedBlockNames($block->getLayout())) {
            return $result;
        }

        if (!isset($blockNames[$block->getNameInLayout()])) {
            return $result;
        }

        return "<div id=\"{$this->helper->getBlockWrapperId($block->getNameInLayout())}\">$result</div>";
    }
}