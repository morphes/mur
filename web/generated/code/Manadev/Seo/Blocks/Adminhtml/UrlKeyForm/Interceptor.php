<?php
namespace Manadev\Seo\Blocks\Adminhtml\UrlKeyForm;

/**
 * Interceptor class for @see \Manadev\Seo\Blocks\Adminhtml\UrlKeyForm
 */
class Interceptor extends \Manadev\Seo\Blocks\Adminhtml\UrlKeyForm implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Framework\ObjectManagerInterface $objectManager, \Manadev\Seo\Enums\UrlKeyStatus $urlKeyStatus, \Manadev\Seo\Enums\UrlKeyType $urlKeyType, \Manadev\Seo\Enums\UrlKeySubType $urlKeySubType, array $data)
    {
        $this->___init();
        parent::__construct($context, $registry, $formFactory, $objectManager, $urlKeyStatus, $urlKeyType, $urlKeySubType, $data);
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
