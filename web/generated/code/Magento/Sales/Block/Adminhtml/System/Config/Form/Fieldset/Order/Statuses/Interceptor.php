<?php
namespace Magento\Sales\Block\Adminhtml\System\Config\Form\Fieldset\Order\Statuses;

/**
 * Interceptor class for @see \Magento\Sales\Block\Adminhtml\System\Config\Form\Fieldset\Order\Statuses
 */
class Interceptor extends \Magento\Sales\Block\Adminhtml\System\Config\Form\Fieldset\Order\Statuses implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Backend\Model\Auth\Session $authSession, \Magento\Framework\View\Helper\Js $jsHelper, \Magento\Sales\Model\ResourceModel\Order\Status\CollectionFactory $orderStatusCollection, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $authSession, $jsHelper, $orderStatusCollection, $data);
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
