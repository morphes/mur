<?php
namespace Magento\Robots\Block\Data;

/**
 * Interceptor class for @see \Magento\Robots\Block\Data
 */
class Interceptor extends \Magento\Robots\Block\Data implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Context $context, \Magento\Robots\Model\Robots $robots, \Magento\Store\Model\StoreResolver $storeResolver, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $robots, $storeResolver, $data);
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
