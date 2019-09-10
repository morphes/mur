<?php
namespace Manadev\LayeredNavigationAjax\Blocks\Apply;

/**
 * Interceptor class for @see \Manadev\LayeredNavigationAjax\Blocks\Apply
 */
class Interceptor extends \Manadev\LayeredNavigationAjax\Blocks\Apply implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Manadev\LayeredNavigationAjax\Configuration $configuration, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $configuration, $data);
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
}
