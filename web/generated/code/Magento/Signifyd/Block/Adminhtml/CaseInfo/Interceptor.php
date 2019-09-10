<?php
namespace Magento\Signifyd\Block\Adminhtml\CaseInfo;

/**
 * Interceptor class for @see \Magento\Signifyd\Block\Adminhtml\CaseInfo
 */
class Interceptor extends \Magento\Signifyd\Block\Adminhtml\CaseInfo implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Signifyd\Model\CaseManagement $caseManagement, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $caseManagement, $data);
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
