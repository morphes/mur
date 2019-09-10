<?php
namespace Bss\CmsPageImportExport\Block\AttributeSet;

/**
 * Interceptor class for @see \Bss\CmsPageImportExport\Block\AttributeSet
 */
class Interceptor extends \Bss\CmsPageImportExport\Block\AttributeSet implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Cms\Ui\Component\Listing\Column\Cms\Options $storeList, \Magento\Framework\View\Element\Html\Select $selectHtml, \Magento\Store\Model\System\Store $systemStore, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $storeList, $selectHtml, $systemStore, $data);
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
