<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Enums;

use Manadev\Core\Source;

class QueryPart extends Source
{
    const PREFIX = 'prefix';
    const SUFFIX = 'suffix';
    const QUERY = 'query';

    public function getOptions() {
        return [
            static::PREFIX => __('URL Path Prefix'),
            static::SUFFIX => __('URL Path Suffix'),
            static::QUERY => __('URL Query'),
        ];
    }
}