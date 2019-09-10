<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSliders\Sources;

use Manadev\Core\Source;
use Manadev\LayeredNavigation\Helper;
use Manadev\LayeredNavigation\Models\Filter;
use Manadev\LayeredNavigation\Models\FilterFactory;
use Manadev\LayeredNavigation\Resources\Collections\FilterCollection;

class MinAttributeSource extends Source
{
    /**
     * @var Helper
     */
    protected $layeredNavHelper;

    public function __construct(
        Helper $layeredNavHelper
) {
        $this->layeredNavHelper = $layeredNavHelper;
    }

    public function getOptions() {
        $options = [];

        $options[''] = "";

        $filterCollection = $this->layeredNavHelper->getAllFilters();
        $filterCollection->addFieldToFilter('min_max_role', ['eq' => "min"])
            ->addFieldToFilter('template', ['eq' => 'min_max_slider']);

        foreach($filterCollection as $filter) {
            $options[$filter['attribute_code']] = $filter['title'] . " (code '". $filter['attribute_code'] ."')";
        }

        return $options;
    }
}