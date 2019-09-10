<?php
namespace MageArray\News\Block\Adminhtml\Newscat\Grid\Renderer\Catname;

/**
 * Interceptor class for @see \MageArray\News\Block\Adminhtml\Newscat\Grid\Renderer\Catname
 */
class Interceptor extends \MageArray\News\Block\Adminhtml\Newscat\Grid\Renderer\Catname implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \MageArray\News\Model\NewscatFactory $newscatFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $newscatFactory, $storeManager, $data);
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
