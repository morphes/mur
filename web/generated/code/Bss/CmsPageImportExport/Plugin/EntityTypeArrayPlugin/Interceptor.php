<?php
namespace Bss\CmsPageImportExport\Plugin\EntityTypeArrayPlugin;

/**
 * Interceptor class for @see \Bss\CmsPageImportExport\Plugin\EntityTypeArrayPlugin
 */
class Interceptor extends \Bss\CmsPageImportExport\Plugin\EntityTypeArrayPlugin implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\ImportExport\Model\Import\ConfigInterface $importConfig, \Magento\Framework\App\Request\Http $request)
    {
        $this->___init();
        parent::__construct($importConfig, $request);
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toOptionArray');
        if (!$pluginInfo) {
            return parent::toOptionArray();
        } else {
            return $this->___callPlugins('toOptionArray', func_get_args(), $pluginInfo);
        }
    }
}
