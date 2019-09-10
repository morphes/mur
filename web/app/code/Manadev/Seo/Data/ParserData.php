<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Data;

use Manadev\Core\Data;
use Magento\Framework\App\Request\Http as Request;
use Manadev\Seo\Data\Parser\SettingsData;
use Manadev\Seo\Data\Parser\TokenData;

/**
 * @property string $path
 * @property int $path_pos
 * @property int $path_length
 * @property int $parent_pos
 * @property int $parent_length
 * @property array $parents
 * @property Request $request
 * @property TokenData[] $extensions
 * @property TokenData[] $delimiters
 * @property TokenData[] $url_keys
 * @property SettingsData $settings
 * @property int $store_id
 * @property TokenData $page_url_key
 * @property string $route
 * @property TokenData $extension
 * @property array $prefix_parameters
 * @property array $suffix_parameters
 * @property TokenData $parameter
 * @property TokenData $parameter_url_key
 * @property TokenData $option_url_key
 * @property mixed $parameter_value
 * @property string $parameter_name
 * @property array $query_parameters
 */
class ParserData extends Data
{

}