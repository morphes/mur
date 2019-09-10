<?php
namespace Dotdigitalgroup\Email\Block\Adminhtml\Config\Rules\Customdatafields;

/**
 * Interceptor class for @see \Dotdigitalgroup\Email\Block\Adminhtml\Config\Rules\Customdatafields
 */
class Interceptor extends \Dotdigitalgroup\Email\Block\Adminhtml\Config\Rules\Customdatafields implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Dotdigitalgroup\Email\Model\Adminhtml\Source\Rules\Condition $condition, \Dotdigitalgroup\Email\Model\Adminhtml\Source\Rules\Value $value, $data = array())
    {
        $this->___init();
        parent::__construct($context, $condition, $value, $data);
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
