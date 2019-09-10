<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Blocks;

use Magento\Framework\View\Element\Template;

class ContentRenderer extends Template
{
    public function render($template, $data)
    {
        $this->setTemplate($template);

        foreach ($data as $key => $value) {
            $this->assign($key, $value);
        }

        $html = $this->_toHtml();

        foreach ($data as $key => $value) {
            $this->assign($key, null);
        }

        return $html;
    }
}