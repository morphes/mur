<?php
namespace Magento\Swatches\Block\Adminhtml\Attribute\Edit\Options\Text;

/**
 * Interceptor class for @see \Magento\Swatches\Block\Adminhtml\Attribute\Edit\Options\Text
 */
class Interceptor extends \Magento\Swatches\Block\Adminhtml\Attribute\Edit\Options\Text implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\CollectionFactory $attrOptionCollectionFactory, \Magento\Framework\Validator\UniversalFactory $universalFactory, \Magento\Catalog\Model\Product\Media\Config $mediaConfig, \Magento\Swatches\Helper\Media $swatchHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $attrOptionCollectionFactory, $universalFactory, $mediaConfig, $swatchHelper, $data);
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
