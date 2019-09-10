<?php
namespace Magento\Catalog\Block\Adminhtml\Product\Edit\Tab\Options\Option;

/**
 * Interceptor class for @see \Magento\Catalog\Block\Adminhtml\Product\Edit\Tab\Options\Option
 */
class Interceptor extends \Magento\Catalog\Block\Adminhtml\Product\Edit\Tab\Options\Option implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Config\Model\Config\Source\Yesno $configYesNo, \Magento\Catalog\Model\Config\Source\Product\Options\Type $optionType, \Magento\Catalog\Model\Product $product, \Magento\Framework\Registry $registry, \Magento\Catalog\Model\ProductOptions\ConfigInterface $productOptionConfig, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $configYesNo, $optionType, $product, $registry, $productOptionConfig, $data);
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
