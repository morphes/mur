<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationAjax;

use Magento\Framework\View\Layout;
use Magento\Framework\View\LayoutInterface;
use Manadev\LayeredNavigationAjax\Blocks\Intercept;

class Helper
{
    protected $blockNames;
    /**
     * @var Intercept
     */
    protected $interceptorBlock;

    public function getBlockWrapperId($blockName) {
        return "mana_ajax_wrapper_" . strtr($blockName, '.-', '__');
    }

    /**
     * @param Layout|LayoutInterface $layout
     * @return array|bool|null
     */
    public function getAjaxRefreshedBlockNames(Layout $layout) {
        if (!$this->blockNames) {
            if (!($interceptor = $this->getInterceptorBlock($layout))) {
                return null;
            }

            $this->blockNames = array_flip(array_unique(array_merge(
                array_map('trim', explode(',',
                    $interceptor->getData('blocks_refreshed_after_category_change')
                )),
                array_map('trim', explode(',',
                    $interceptor->getData('blocks_refreshed_staying_in_same_category')
                ))
            )));
        }

        return $this->blockNames;
    }

    /**
     * @param Layout $layout
     * @return Intercept
     */
    public function getInterceptorBlock(Layout $layout) {
        if (!$this->interceptorBlock) {
            $this->interceptorBlock = $layout->getBlock('mana.layered-nav.ajax.interceptor');
        }

        return $this->interceptorBlock;
    }
}