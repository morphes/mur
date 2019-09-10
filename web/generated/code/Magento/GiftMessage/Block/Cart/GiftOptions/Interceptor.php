<?php
namespace Magento\GiftMessage\Block\Cart\GiftOptions;

/**
 * Interceptor class for @see \Magento\GiftMessage\Block\Cart\GiftOptions
 */
class Interceptor extends \Magento\GiftMessage\Block\Cart\GiftOptions implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Json\Encoder $jsonEncoder, \Magento\GiftMessage\Model\CompositeConfigProvider $configProvider, array $layoutProcessors = array(), array $data = array())
    {
        $this->___init();
        parent::__construct($context, $jsonEncoder, $configProvider, $layoutProcessors, $data);
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
