<?php
namespace WeltPixel\OwlCarouselSlider\Block\Slider\Custom;

/**
 * Interceptor class for @see \WeltPixel\OwlCarouselSlider\Block\Slider\Custom
 */
class Interceptor extends \WeltPixel\OwlCarouselSlider\Block\Slider\Custom implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Registry $registry, \WeltPixel\OwlCarouselSlider\Helper\Custom $helperCustom, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $helperCustom, $data);
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
