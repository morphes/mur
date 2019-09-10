<?php
namespace WeltPixel\OwlCarouselSlider\Block\Adminhtml\Banner\Helper\Renderer\Image;

/**
 * Interceptor class for @see \WeltPixel\OwlCarouselSlider\Block\Adminhtml\Banner\Helper\Renderer\Image
 */
class Interceptor extends \WeltPixel\OwlCarouselSlider\Block\Adminhtml\Banner\Helper\Renderer\Image implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, \WeltPixel\OwlCarouselSlider\Model\BannerFactory $bannerFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $storeManager, $bannerFactory, $data);
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
