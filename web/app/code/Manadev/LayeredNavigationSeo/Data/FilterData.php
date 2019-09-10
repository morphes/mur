<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Data;

use Manadev\Core\Data;
use Manadev\LayeredNavigation\EngineFilter;
use Manadev\LayeredNavigation\Models\Filter;

/**
 * @property EngineFilter $engine_filter
 * @property Filter $filter
 * @property string $filter_name
 * @property string $filter_title
 * @property array $item
 * @property string $item_label
 * @property bool $included
 */
class FilterData extends Data
{

}