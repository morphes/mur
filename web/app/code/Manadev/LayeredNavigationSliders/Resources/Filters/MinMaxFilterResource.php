<?php

namespace Manadev\LayeredNavigationSliders\Resources\Filters;

use Manadev\Core\Exceptions\NotSupported;
use Manadev\LayeredNavigationSliders\Filters\MinMaxFilter;
use Manadev\ProductCollection\Enums\Operation;
use Manadev\ProductCollection\Resources\Filters\LayeredFilters\DecimalFilterResource;
use Magento\Framework\DB\Select;
use Manadev\ProductCollection\Contracts\Filter;

class MinMaxFilterResource extends DecimalFilterResource
{
    /**
     * @param Select $select
     * @param Filter $filter
     * @param $callback
     * @return false|string
     * @throws NotSupported
     */
    public function apply(Select $select, Filter $filter, $callback) {
        /* @var $filter MinMaxFilter */
        if ($filter->getOperation() != Operation::LOGICAL_OR) {
            throw new NotSupported();
        }

        $alias = $filter->getFullName() . '_min';
        $maxAlias = $filter->getFullName() . '_max';
        $connection = $this->getConnection();

        $valueExpr = "`$alias`.`value`";
        $maxValueExpr = "`$maxAlias`.`value`";

        $db = $this->getConnection();

        $parentExpr = "";
        foreach ($filter->getRanges() as $range) {
            list($from, $to) = $range;
            $expr = "";

            if ($from !== '') {
                $expr = $db->quoteInto("$maxValueExpr >= ?", $from);
            }
            if ($to !== '') {
                if(!$filter->getIsToRangeInclusive()) {
                    $to -= 0.001;
                }

                if ($expr) {
                    $expr .= " AND ";
                }
                $expr .= $db->quoteInto("$valueExpr <= ?", $to);
            }

            if ($expr) {
                if ($parentExpr) {
                    $parentExpr .= " OR ";
                }
                $parentExpr .= "($expr)";
            }
        }

        $select->joinInner([$alias => $this->getMainTable()],
            "`{$alias}`.`entity_id` = `e`.`entity_id` AND " .
            $connection->quoteInto("`{$alias}`.`attribute_id` = ?", $filter->getAttributeId()) . " AND " .
            $connection->quoteInto("`{$alias}`.`store_id` = ?", $this->getStoreId()));
        $select->joinInner([$maxAlias => $this->getMainTable()],
            "`{$maxAlias}`.`entity_id` = `e`.`entity_id` AND " .
            $connection->quoteInto("`{$maxAlias}`.`attribute_id` = ?", $filter->getMaxAttributeId()) . " AND " .
            $connection->quoteInto("`{$maxAlias}`.`store_id` = ?", $this->getStoreId()));

        $select->where($parentExpr);

        return false;

    }

}