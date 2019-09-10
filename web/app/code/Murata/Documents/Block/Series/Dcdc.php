<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Murata\Documents\Block\Series;

/**
 * Footer
 *
 * @api
 * @since 100.0.2
 */
class Dcdc extends \Murata\Documents\Block\Series\SeriesAbstract
{
    protected $_template = 'Murata_Documents::series/dcdc.phtml';

    public function getLoadedProductCollection()
    {
        return $this->getSeriesCollection('DC-DC Converter');
    }
}
