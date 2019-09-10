<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */
namespace Manadev\LayeredNavigationMobile\Contracts;

use Manadev\LayeredNavigation\EngineFilter;
use Manadev\LayeredNavigationMobile\Blocks\MobileNavigation;

interface MobileBehavior
{
    /**
     * @param MobileNavigation $block
     * @return string
     */
    public function getParentMageInit($block);

    /**
     * @param MobileNavigation $block
     * @param EngineFilter $filter
     * @return string
     */
    public function getChildMageInit($block, $filter);

    /**
     * @return string
     */
    public function getLabel();
}