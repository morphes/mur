<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Resources\Collections;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class UrlKeyCollection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Manadev\Seo\Models\UrlKey', 'Manadev\Seo\Resources\UrlKeyResource');
    }

}