<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Enums;

use Manadev\Core\Source;

class CanonicalOnSecondAndFurtherPage extends Source
{
    const NEVER = 'never';
    const ON_NON_FILTERED_PAGES_ONLY = 'non_filtered_pages';
    const ON_ALL_PAGES_EXCEPT_HAVING_TOOLBAR_PARAMETERS = 'all_pages';

    public function getOptions() {
        return [
            static::NEVER => __('Never'),
            static::ON_NON_FILTERED_PAGES_ONLY => __('On non-filtered pages only (`category/page/N`)'),
            static::ON_ALL_PAGES_EXCEPT_HAVING_TOOLBAR_PARAMETERS => __('On all pages except having toolbar parameters (`category/filter/value/page/N`)'),
        ];
    }
}