<?php
namespace Magento\Translation\Block\Html\Head\Config;

/**
 * Interceptor class for @see \Magento\Translation\Block\Html\Head\Config
 */
class Interceptor extends \Magento\Translation\Block\Html\Head\Config implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Context $context, \Magento\Framework\View\Page\Config $pageConfig, \Magento\Translation\Model\FileManager $fileManager, \Magento\Framework\Translate\Inline $inline, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $pageConfig, $fileManager, $inline, $data);
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
