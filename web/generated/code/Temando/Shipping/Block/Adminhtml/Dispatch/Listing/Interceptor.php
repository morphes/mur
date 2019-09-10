<?php
namespace Temando\Shipping\Block\Adminhtml\Dispatch\Listing;

/**
 * Interceptor class for @see \Temando\Shipping\Block\Adminhtml\Dispatch\Listing
 */
class Interceptor extends \Temando\Shipping\Block\Adminhtml\Dispatch\Listing implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Widget\Context $context, \Temando\Shipping\Webservice\Config\WsConfigInterface $config, \Magento\Backend\Model\Auth\StorageInterface $session, \Temando\Shipping\Rest\AuthenticationInterface $auth, \Magento\Integration\Model\Oauth\Token $token, \Magento\Framework\Stdlib\DateTime\DateTime $dateTime, \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remoteAddress, \Magento\Security\Model\Config $securityConfig, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $config, $session, $auth, $token, $dateTime, $remoteAddress, $securityConfig, $data);
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
