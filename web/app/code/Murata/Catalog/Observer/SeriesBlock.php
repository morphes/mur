<?php
namespace Murata\Catalog\Observer;

class SeriesBlock implements \Magento\Framework\Event\ObserverInterface
{
    const ATTRIBUTE_SET_ID_SERIES = 50;

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $collection = $observer->getEvent()->getCollection();
        $collection->addAttributeToFilter('attribute_set_id', ['nin' => [self::ATTRIBUTE_SET_ID_SERIES]]);
        return $this;
    }
}