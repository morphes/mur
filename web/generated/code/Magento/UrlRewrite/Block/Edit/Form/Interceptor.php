<?php
namespace Magento\UrlRewrite\Block\Edit\Form;

/**
 * Interceptor class for @see \Magento\UrlRewrite\Block\Edit\Form
 */
class Interceptor extends \Magento\UrlRewrite\Block\Edit\Form implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Widget\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\UrlRewrite\Model\OptionProvider $optionProvider, \Magento\UrlRewrite\Model\UrlRewriteFactory $rewriteFactory, \Magento\Store\Model\System\Store $systemStore, \Magento\Backend\Helper\Data $adminhtmlData, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $formFactory, $optionProvider, $rewriteFactory, $systemStore, $adminhtmlData, $data);
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
