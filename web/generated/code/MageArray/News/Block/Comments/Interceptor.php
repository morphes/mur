<?php
namespace MageArray\News\Block\Comments;

/**
 * Interceptor class for @see \MageArray\News\Block\Comments
 */
class Interceptor extends \MageArray\News\Block\Comments implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \MageArray\News\Model\NewscommentFactory $newscommentFactory, \MageArray\News\Helper\Data $dataHelper, \MageArray\News\Model\Customerdata $customerData, \Magento\Framework\Locale\ResolverInterface $localeResolver, \Magento\Framework\Registry $coreRegistry, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $newscommentFactory, $dataHelper, $customerData, $localeResolver, $coreRegistry, $data);
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
