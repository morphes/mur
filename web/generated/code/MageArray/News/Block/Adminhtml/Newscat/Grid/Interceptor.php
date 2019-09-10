<?php
namespace MageArray\News\Block\Adminhtml\Newscat\Grid;

/**
 * Interceptor class for @see \MageArray\News\Block\Adminhtml\Newscat\Grid
 */
class Interceptor extends \MageArray\News\Block\Adminhtml\Newscat\Grid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Backend\Helper\Data $backendHelper, \MageArray\News\Model\NewscatFactory $newscatFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $backendHelper, $newscatFactory, $data);
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
