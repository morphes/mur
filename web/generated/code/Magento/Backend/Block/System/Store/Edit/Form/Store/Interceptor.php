<?php
namespace Magento\Backend\Block\System\Store\Edit\Form\Store;

/**
 * Interceptor class for @see \Magento\Backend\Block\System\Store\Edit\Form\Store
 */
class Interceptor extends \Magento\Backend\Block\System\Store\Edit\Form\Store implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Store\Model\GroupFactory $groupFactory, \Magento\Store\Model\WebsiteFactory $websiteFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $formFactory, $groupFactory, $websiteFactory, $data);
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
