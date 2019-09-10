<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationShowMore\Blocks;

use Magento\Backend\Block\Template;
use Manadev\LayeredNavigation\Models\Filter;
use Manadev\LayeredNavigationShowMore\Sources\MethodOfShowingItems;

class ShowMore extends Template
{
    protected $_template = 'Manadev_LayeredNavigationShowMore::show_more.phtml';

    public function __construct(Template\Context $context, array $data = []) {
        parent::__construct($context, $data);
    }

    public function getJsComponent() {
        switch($this->getData('show_more_method')) {
            case MethodOfShowingItems::SCROLLBAR:
                return 'showMoreScrollBar';
            case MethodOfShowingItems::POPUP:
                return 'showMorePopup';
            case MethodOfShowingItems::SHOW_MORE_AND_SHOW_LESS:
                return 'showMoreShowLess';
        }

        return false;
    }

    public function getClass() {
        switch($this->getData('show_more_method')) {
            case MethodOfShowingItems::SHOW_MORE_AND_SHOW_LESS:
                return 'show-more-show-less';
            case MethodOfShowingItems::SCROLLBAR:
                return 'scrollbar';
        }

        return '';
    }

    public function toHtml() {
        if(!$this->getJsComponent()) {
            return "";
        }

        return parent::toHtml();
    }


}