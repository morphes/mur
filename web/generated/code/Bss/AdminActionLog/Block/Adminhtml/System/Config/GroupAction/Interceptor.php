<?php
namespace Bss\AdminActionLog\Block\Adminhtml\System\Config\GroupAction;

/**
 * Interceptor class for @see \Bss\AdminActionLog\Block\Adminhtml\System\Config\GroupAction
 */
class Interceptor extends \Bss\AdminActionLog\Block\Adminhtml\System\Config\GroupAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Bss\AdminActionLog\Model\Config\Source\GroupAction $groupaction, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $groupaction, $data);
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
