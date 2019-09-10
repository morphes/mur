<?php
namespace Magento\Cms\Block\Adminhtml\Page\Grid\Renderer\Action;

/**
 * Interceptor class for @see \Magento\Cms\Block\Adminhtml\Page\Grid\Renderer\Action
 */
class Interceptor extends \Magento\Cms\Block\Adminhtml\Page\Grid\Renderer\Action implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Cms\Block\Adminhtml\Page\Grid\Renderer\Action\UrlBuilder $actionUrlBuilder, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $actionUrlBuilder, $data);
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
