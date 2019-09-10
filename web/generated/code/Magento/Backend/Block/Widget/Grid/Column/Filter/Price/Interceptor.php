<?php
namespace Magento\Backend\Block\Widget\Grid\Column\Filter\Price;

/**
 * Interceptor class for @see \Magento\Backend\Block\Widget\Grid\Column\Filter\Price
 */
class Interceptor extends \Magento\Backend\Block\Widget\Grid\Column\Filter\Price implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Framework\DB\Helper $resourceHelper, \Magento\Directory\Model\Currency $currencyModel, \Magento\Directory\Model\Currency\DefaultLocator $currencyLocator, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $resourceHelper, $currencyModel, $currencyLocator, $data);
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
