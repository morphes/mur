<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Models;

use Magento\Framework\Model\AbstractModel;

class UrlKey extends AbstractModel
{
    protected $_eventPrefix = 'mana_url_key';

    protected function _construct()
    {
        $this->_init('Manadev\Seo\Resources\UrlKeyResource');
    }
}