<?php
namespace MageArray\News\Block\Widget\Category;

/**
 * Interceptor class for @see \MageArray\News\Block\Widget\Category
 */
class Interceptor extends \MageArray\News\Block\Widget\Category implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, array $data, \MageArray\News\Model\NewspostFactory $modelNewsFactory, \MageArray\News\Model\NewscatFactory $modelNewsCategoriesFactory)
    {
        $this->___init();
        parent::__construct($context, $data, $modelNewsFactory, $modelNewsCategoriesFactory);
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
