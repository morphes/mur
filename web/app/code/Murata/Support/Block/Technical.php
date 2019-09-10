<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Murata\Support\Block;

/**
 * Footer
 *
 * @api
 * @since 100.0.2
 */
class Technical extends \Magento\Framework\View\Element\Template
{
    //protected $_template = 'Murata_Support::support/technical.phtml';


    public function toHtml()
    {
        include('lib/MPS/mail_forms_all/contact.php');
    }
}
