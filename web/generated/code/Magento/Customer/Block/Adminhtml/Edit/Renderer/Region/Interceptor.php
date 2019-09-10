<?php
namespace Magento\Customer\Block\Adminhtml\Edit\Renderer\Region;

/**
 * Interceptor class for @see \Magento\Customer\Block\Adminhtml\Edit\Renderer\Region
 */
class Interceptor extends \Magento\Customer\Block\Adminhtml\Edit\Renderer\Region implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Directory\Helper\Data $directoryHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $directoryHelper, $data);
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
