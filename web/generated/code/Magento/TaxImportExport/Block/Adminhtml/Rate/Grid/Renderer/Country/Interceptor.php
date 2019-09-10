<?php
namespace Magento\TaxImportExport\Block\Adminhtml\Rate\Grid\Renderer\Country;

/**
 * Interceptor class for @see \Magento\TaxImportExport\Block\Adminhtml\Rate\Grid\Renderer\Country
 */
class Interceptor extends \Magento\TaxImportExport\Block\Adminhtml\Rate\Grid\Renderer\Country implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Framework\Locale\ListsInterface $localeLists, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $localeLists, $data);
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
