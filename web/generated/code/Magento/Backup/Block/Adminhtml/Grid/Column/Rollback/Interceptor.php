<?php
namespace Magento\Backup\Block\Adminhtml\Grid\Column\Rollback;

/**
 * Interceptor class for @see \Magento\Backup\Block\Adminhtml\Grid\Column\Rollback
 */
class Interceptor extends \Magento\Backup\Block\Adminhtml\Grid\Column\Rollback implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Backup\Helper\Data $backupHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $backupHelper, $data);
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
