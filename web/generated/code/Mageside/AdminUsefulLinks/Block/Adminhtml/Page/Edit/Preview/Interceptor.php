<?php
namespace Mageside\AdminUsefulLinks\Block\Adminhtml\Page\Edit\Preview;

/**
 * Interceptor class for @see \Mageside\AdminUsefulLinks\Block\Adminhtml\Page\Edit\Preview
 */
class Interceptor extends \Mageside\AdminUsefulLinks\Block\Adminhtml\Page\Edit\Preview implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\AuthorizationInterface $authorization, \Mageside\AdminUsefulLinks\Helper\Config $helperConfig, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $authorization, $helperConfig, $data);
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
