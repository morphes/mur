<?php
namespace Magento\Catalog\Block\Adminhtml\Category\Tab\Product;

/**
 * Interceptor class for @see \Magento\Catalog\Block\Adminhtml\Category\Tab\Product
 */
class Interceptor extends \Magento\Catalog\Block\Adminhtml\Category\Tab\Product implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Backend\Helper\Data $backendHelper, \Magento\Catalog\Model\ProductFactory $productFactory, \Magento\Framework\Registry $coreRegistry, array $data = array(), \Magento\Catalog\Model\Product\Visibility $visibility = null, \Magento\Catalog\Model\Product\Attribute\Source\Status $status = null)
    {
        $this->___init();
        parent::__construct($context, $backendHelper, $productFactory, $coreRegistry, $data, $visibility, $status);
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
