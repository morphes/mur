<?php
namespace Manadev\LayeredNavigationSettings\Blocks\Adminhtml\FilterForm;

/**
 * Interceptor class for @see \Manadev\LayeredNavigationSettings\Blocks\Adminhtml\FilterForm
 */
class Interceptor extends \Manadev\LayeredNavigationSettings\Blocks\Adminhtml\FilterForm implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Framework\ObjectManagerInterface $objectManager, \Manadev\Core\Sources\YesNoSource $yesNoSource, \Manadev\LayeredNavigation\Registries\FilterTypes $filterTypes, \Manadev\LayeredNavigation\Sources\OptionOrderSource $optionOrderSource, array $data)
    {
        $this->___init();
        parent::__construct($context, $registry, $formFactory, $objectManager, $yesNoSource, $filterTypes, $optionOrderSource, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function assignForm($form, $dbFields, $filterDefaults)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'assignForm');
        if (!$pluginInfo) {
            return parent::assignForm($form, $dbFields, $filterDefaults);
        } else {
            return $this->___callPlugins('assignForm', func_get_args(), $pluginInfo);
        }
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
