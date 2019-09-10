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
class Acdc extends \Murata\Documents\Block\Series\SeriesAbstract
{
    protected $_template = 'Murata_Documents::series/acdc.phtml';

    public function getLoadedProductCollection()
    {
        return $this->getSeriesCollection('AC-DC Power Supply');
    }
}
