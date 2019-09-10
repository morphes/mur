<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Enums;

use Manadev\Core\Source;

class UrlKeyStatus extends Source
{
    const ACTIVE = 'active';
    const REDIRECTED = 'redirected';
    const DISABLED = 'disabled';

    public function getOptions() {
        return [
            static::ACTIVE => __('Active'),
            static::REDIRECTED => __('Redirected'),
            static::DISABLED => __('Disabled'),
        ];
    }
}