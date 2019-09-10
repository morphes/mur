<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationShowMore\Sources;

use Manadev\Core\Source;

class MethodOfShowingItems extends Source
{
    const SHOW_MORE_AND_SHOW_LESS = 'show_more_and_show_less';
    const SCROLLBAR = 'scrollbar';
    const POPUP = 'popup';

    public function getOptions() {
        return [
            self::SHOW_MORE_AND_SHOW_LESS => __("'Show More' and 'Show Less' actions"),
            self::SCROLLBAR => __("Scroll bar"),
            //self::POPUP => __("'Show More' popup"),
        ];
    }
}