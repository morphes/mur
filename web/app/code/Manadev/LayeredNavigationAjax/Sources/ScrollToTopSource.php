<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationAjax\Sources;

use Manadev\Core\Source;

class ScrollToTopSource extends Source
{
    public function getOptions() {
        return [
            'never' => __('Never'),
            'after_pager_clicks' => __("After Pager Clicks"),
            'after_any_ajax_action' => __("After Any AJAX Action"),
        ];
    }
}