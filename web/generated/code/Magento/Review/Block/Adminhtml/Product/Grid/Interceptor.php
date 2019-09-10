<?php
namespace Magento\Review\Block\Adminhtml\Product\Grid;

/**
 * Interceptor class for @see \Magento\Review\Block\Adminhtml\Product\Grid
 */
class Interceptor extends \Magento\Review\Block\Adminhtml\Product\Grid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Backend\Helper\Data $backendHelper, \Magento\Store\Model\WebsiteFactory $websiteFactory, \Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory $setsFactory, \Magento\Catalog\Model\ProductFactory $productFactory, \Magento\Catalog\Model\Product\Type $type, \Magento\Catalog\Model\Product\Attribute\Source\Status $status, \Magento\Catalog\Model\Product\Visibility $visibility, \Magento\Framework\Module\Manager $moduleManager, \Magento\Store\Model\ResourceModel\Website\CollectionFactory $websitesFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $backendHelper, $websiteFactory, $setsFactory, $productFactory, $type, $status, $visibility, $moduleManager, $websitesFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function fetchView($fileName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'fetchView');
        if (!$pluginInfo) {
            return parent::fetchView($fileName);
        } else {
            return $this->___callPlugins('fetchView', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function toHtml()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toHtml');
        if (!$pluginInfo) {
            return parent::toHtml();
        } else {
            return $this->___callPlugins('toHtml', func_get_args(), $pluginInfo);
        }
    }
}
