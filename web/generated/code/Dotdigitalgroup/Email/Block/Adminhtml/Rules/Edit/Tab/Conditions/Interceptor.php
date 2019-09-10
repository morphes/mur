<?php
namespace Dotdigitalgroup\Email\Block\Adminhtml\Rules\Edit\Tab\Conditions;

/**
 * Interceptor class for @see \Dotdigitalgroup\Email\Block\Adminhtml\Rules\Edit\Tab\Conditions
 */
class Interceptor extends \Dotdigitalgroup\Email\Block\Adminhtml\Rules\Edit\Tab\Conditions implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Widget\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Dotdigitalgroup\Email\Model\Adminhtml\Source\Rules\Type $options, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $formFactory, $options, $data);
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
