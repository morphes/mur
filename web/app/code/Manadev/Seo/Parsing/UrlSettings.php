<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Seo\Data\Parser\SettingsData;

interface UrlSettings
{
    /**
     * @return SettingsData
     */
    public function getSettings();
}