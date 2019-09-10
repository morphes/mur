<?php
namespace Dotdigitalgroup\Email\Block\Adminhtml\Config\Trial;

/**
 * Interceptor class for @see \Dotdigitalgroup\Email\Block\Adminhtml\Config\Trial
 */
class Interceptor extends \Dotdigitalgroup\Email\Block\Adminhtml\Config\Trial implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Backend\Model\Auth\Session $authSession, \Magento\Framework\View\Helper\Js $jsHelper, \Magento\Framework\HTTP\PhpEnvironment\ServerAddress $serverAddress, \Magento\Framework\App\Request\Http $request, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Stdlib\DateTime\Timezone $localeDate, \Dotdigitalgroup\Email\Helper\Data $helper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $authSession, $jsHelper, $serverAddress, $request, $storeManager, $localeDate, $helper, $data);
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
