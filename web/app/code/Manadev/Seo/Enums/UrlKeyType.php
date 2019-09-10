<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Enums;

use Manadev\Core\Source;

class UrlKeyType extends Source
{
    // `type` field
    const PAGE = 'page';
    const PARAMETER = 'parameter';
    const OPTION = 'option';

    public function getOptions() {
        return [
            static::PAGE => __('Page'),
            static::PARAMETER => __('Parameter'),
            static::OPTION => __('Option'),
        ];
    }
}