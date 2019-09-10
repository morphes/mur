<?php
namespace WeltPixel\OwlCarouselSlider\Block\Adminhtml\Slider\Grid;

/**
 * Interceptor class for @see \WeltPixel\OwlCarouselSlider\Block\Adminhtml\Slider\Grid
 */
class Interceptor extends \WeltPixel\OwlCarouselSlider\Block\Adminhtml\Slider\Grid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Backend\Helper\Data $backendHelper, \WeltPixel\OwlCarouselSlider\Model\ResourceModel\Slider\CollectionFactory $sliderCollectionFactory, \WeltPixel\OwlCarouselSlider\Helper\Data $bannersliderHelper, \WeltPixel\OwlCarouselSlider\Model\Status $status, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $backendHelper, $sliderCollectionFactory, $bannersliderHelper, $status, $data);
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
