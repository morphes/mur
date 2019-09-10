<?php
/**
 * Copyright © 2015 Thienphucvx.com. All rights reserved.
 */
namespace Murata\Layout\Model;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
class Layout  implements ObserverInterface
{
    protected $_logger;
    public function __construct ( \Psr\Log\LoggerInterface $logger
    ) {
        $this->_logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $layout = $observer->getEvent()->getLayout();
        $xml = $layout->getXmlString();
        $xmlAs = $layout->getNode();
        return $this;
    }
}