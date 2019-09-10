<?php
namespace Magento\SendFriend\Block\Send;

/**
 * Interceptor class for @see \Magento\SendFriend\Block\Send
 */
class Interceptor extends \Magento\SendFriend\Block\Send implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Customer\Model\Session $customerSession, \Magento\SendFriend\Helper\Data $sendfriendData, \Magento\Framework\Registry $registry, \Magento\Customer\Helper\View $customerViewHelper, \Magento\Framework\App\Http\Context $httpContext, \Magento\SendFriend\Model\SendFriend $sendfriend, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $customerSession, $sendfriendData, $registry, $customerViewHelper, $httpContext, $sendfriend, $data);
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
