<?php
namespace Bss\CmsPageImportExport\Block\Adminhtml\Export\Edit\Form;

/**
 * Interceptor class for @see \Bss\CmsPageImportExport\Block\Adminhtml\Export\Edit\Form
 */
class Interceptor extends \Bss\CmsPageImportExport\Block\Adminhtml\Export\Edit\Form implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\ImportExport\Model\Source\Export\EntityFactory $entityFactory, \Magento\ImportExport\Model\Source\Export\FormatFactory $formatFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $formFactory, $entityFactory, $formatFactory, $data);
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
