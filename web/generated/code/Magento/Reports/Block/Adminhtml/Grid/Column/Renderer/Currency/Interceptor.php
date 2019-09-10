<?php
namespace Magento\Reports\Block\Adminhtml\Grid\Column\Renderer\Currency;

/**
 * Interceptor class for @see \Magento\Reports\Block\Adminhtml\Grid\Column\Renderer\Currency
 */
class Interceptor extends \Magento\Reports\Block\Adminhtml\Grid\Column\Renderer\Currency implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Directory\Model\Currency\DefaultLocator $currencyLocator, \Magento\Directory\Model\CurrencyFactory $currencyFactory, \Magento\Framework\Locale\CurrencyInterface $localeCurrency, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $storeManager, $currencyLocator, $currencyFactory, $localeCurrency, $data);
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
