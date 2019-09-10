<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Blocks\Adminhtml;

class UrlKeyGridContainer extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Initialize object state with incoming parameters
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'urlKey';
        $this->_blockGroup = 'Manadev_Seo';
        $this->_headerText = __('Manadev SEO URL Keys');
        parent::_construct();
        $this->buttonList->remove('add');
    }
}
