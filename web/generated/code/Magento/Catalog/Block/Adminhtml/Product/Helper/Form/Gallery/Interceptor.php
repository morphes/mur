<?php
namespace Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Gallery;

/**
 * Interceptor class for @see \Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Gallery
 */
class Interceptor extends \Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Gallery implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Registry $registry, \Magento\Framework\Data\Form $form, $data = array(), \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor = null)
    {
        $this->___init();
        parent::__construct($context, $storeManager, $registry, $form, $data, $dataPersistor);
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
