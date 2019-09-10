<?php
namespace Magento\Wishlist\Block\Cart\Item\Renderer\Actions\MoveToWishlist;

/**
 * Interceptor class for @see \Magento\Wishlist\Block\Cart\Item\Renderer\Actions\MoveToWishlist
 */
class Interceptor extends \Magento\Wishlist\Block\Cart\Item\Renderer\Actions\MoveToWishlist implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Wishlist\Helper\Data $wishlistHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $wishlistHelper, $data);
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
