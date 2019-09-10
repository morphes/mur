<?php
namespace Manadev\Core\Blocks\Adminhtml\Chooser\Product;

/**
 * Interceptor class for @see \Manadev\Core\Blocks\Adminhtml\Chooser\Product
 */
class Interceptor extends \Manadev\Core\Blocks\Adminhtml\Chooser\Product implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Backend\Helper\Data $backendHelper, \Magento\Catalog\Model\CategoryFactory $categoryFactory, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory, \Magento\Catalog\Model\ResourceModel\Category $resourceCategory, \Magento\Catalog\Model\ResourceModel\Product $resourceProduct, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $backendHelper, $categoryFactory, $collectionFactory, $resourceCategory, $resourceProduct, $data);
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
