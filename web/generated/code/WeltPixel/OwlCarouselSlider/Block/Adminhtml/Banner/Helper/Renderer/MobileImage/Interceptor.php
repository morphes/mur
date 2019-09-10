<?php
namespace WeltPixel\OwlCarouselSlider\Block\Adminhtml\Banner\Helper\Renderer\MobileImage;

/**
 * Interceptor class for @see \WeltPixel\OwlCarouselSlider\Block\Adminhtml\Banner\Helper\Renderer\MobileImage
 */
class Interceptor extends \WeltPixel\OwlCarouselSlider\Block\Adminhtml\Banner\Helper\Renderer\MobileImage implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $data);
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
