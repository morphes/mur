<?php
namespace Magento\Config\Block\System\Config\Form;

/**
 * Interceptor class for @see \Magento\Config\Block\System\Config\Form
 */
class Interceptor extends \Magento\Config\Block\System\Config\Form implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Config\Model\Config\Factory $configFactory, \Magento\Config\Model\Config\Structure $configStructure, \Magento\Config\Block\System\Config\Form\Fieldset\Factory $fieldsetFactory, \Magento\Config\Block\System\Config\Form\Field\Factory $fieldFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $formFactory, $configFactory, $configStructure, $fieldsetFactory, $fieldFactory, $data);
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
