<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Data;

use Manadev\Core\Data;

/**
 * @property int $id
 * @property string $url_key
 * @property string $status
 * @property int $position
 * @property string $type
 * @property string $sub_type
 * @property int $store_id
 * @property int $category_id
 * @property int $cms_page_id
 * @property int $option_id
 * @property string $unique_key
 * @property string $inferred_url_key
 * @property string $assigned_url_key
 * @property string $conflicting_url_key
 * @property string $conflict_resolution
 * @property string $route
 * @property string $param_name
 * @property bool $requires_param_name
 * @property string $description
 * @property string $reference
 * @property int $filter_id
 * @property string $url_part
 */
class UrlKeyData extends Data
{
}