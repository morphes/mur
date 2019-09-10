<?php
namespace Murata\Layout\Observer;

use Magento\Framework\Event\ObserverInterface;

class AdminhtmlBlockHtmlBefore implements ObserverInterface
{
    protected $_resource;
    protected $connection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\App\ResourceConnection $resource,
        array $data = []
    ) {
        $this->_resource = $resource;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->getConnection()->query('UPDATE cataloginventory_stock_status SET stock_status = 1');
    }

    protected function getConnection()
    {
        if (!$this->connection) {
            $this->connection = $this->_resource->getConnection('core_write');
        }
        return $this->connection;
    }
}