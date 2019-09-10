<?php
namespace Magento\Integration\Block\Adminhtml\Integration\Edit\Tab\Webapi;

/**
 * Interceptor class for @see \Magento\Integration\Block\Adminhtml\Integration\Edit\Tab\Webapi
 */
class Interceptor extends \Magento\Integration\Block\Adminhtml\Integration\Edit\Tab\Webapi implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Framework\Acl\RootResource $rootResource, \Magento\Framework\Acl\AclResource\ProviderInterface $aclResourceProvider, \Magento\Integration\Helper\Data $integrationData, \Magento\Integration\Api\IntegrationServiceInterface $integrationService, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $formFactory, $rootResource, $aclResourceProvider, $integrationData, $integrationService, $data);
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
