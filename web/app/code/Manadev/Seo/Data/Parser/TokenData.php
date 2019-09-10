<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Data\Parser;

use Manadev\Core\Data;
use Manadev\Seo\Data\UrlKeyData;

/**
 * @property string $text
 * @property int $pos
 * @property int $length
 * @property string[] $routes
 * @property TokenData|false $delimiter_before
 * @property TokenData|false $delimiter_after
 * @property UrlKeyData $record
 */
class TokenData extends Data
{

}