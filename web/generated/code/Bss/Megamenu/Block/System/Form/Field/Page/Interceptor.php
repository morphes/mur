<?php
namespace Bss\Megamenu\Block\System\Form\Field\Page;

/**
 * Interceptor class for @see \Bss\Megamenu\Block\System\Form\Field\Page
 */
class Interceptor extends \Bss\Megamenu\Block\System\Form\Field\Page implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Context $context, \Magento\Cms\Model\ResourceModel\Page\CollectionFactory $factory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $factory, $data);
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
