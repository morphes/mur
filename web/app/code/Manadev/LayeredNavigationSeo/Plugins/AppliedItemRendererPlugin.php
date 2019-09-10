<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Plugins;

use Manadev\Core\Features;
use Manadev\LayeredNavigationSeo\LinkContent;

class AppliedItemRendererPlugin
{
    /**
     * @var Features
     */
    protected $features;
    /**
     * @var LinkContent
     */
    protected $linkContent;

    public function __construct(Features $features, LinkContent $linkContent)
    {
        $this->features = $features;
        $this->linkContent = $linkContent;
    }

    public function aroundGetRemoveLinkAttributes($block, callable $proceed, ...$args) {
        $result = $proceed(...$args);
        if (!$this->features->isEnabled(__CLASS__)) {
            return $result;
        }

        if (!($html = $this->linkContent->noFollow())) {
            return $result;
        }

        if ($result) {
            $result .= ' ';
        }

        return $result . $html;
    }
}