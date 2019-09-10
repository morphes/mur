<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Murata\Documents\Block\Certificates;

/**
 * Footer
 *
 * @api
 * @since 100.0.2
 */
class Acdc extends \Murata\Documents\Block\Certificates\CertificatesAbstract
{
    protected $_template = 'Murata_Documents::certificates/acdc.phtml';

    public function getLoadedProductCollection()
    {
        return $this->getCertificatesCollection('AC-DC Power Supply');
    }
}
