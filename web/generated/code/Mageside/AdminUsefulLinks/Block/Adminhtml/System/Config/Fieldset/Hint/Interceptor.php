<?php
namespace Mageside\AdminUsefulLinks\Block\Adminhtml\System\Config\Fieldset\Hint;

/**
 * Interceptor class for @see \Mageside\AdminUsefulLinks\Block\Adminhtml\System\Config\Fieldset\Hint
 */
class Interceptor extends \Mageside\AdminUsefulLinks\Block\Adminhtml\System\Config\Fieldset\Hint implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\App\ProductMetadataInterface $productMetaData, \Magento\Framework\Module\ModuleList\Loader $loader, \Mageside\AdminUsefulLinks\Helper\Config $helper, $data = array())
    {
        $this->___init();
        parent::__construct($context, $productMetaData, $loader, $helper, $data);
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
