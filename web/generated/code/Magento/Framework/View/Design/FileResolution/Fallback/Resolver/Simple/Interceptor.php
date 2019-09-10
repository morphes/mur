<?php
namespace Magento\Framework\View\Design\FileResolution\Fallback\Resolver\Simple;

/**
 * Interceptor class for @see \Magento\Framework\View\Design\FileResolution\Fallback\Resolver\Simple
 */
class Interceptor extends \Magento\Framework\View\Design\FileResolution\Fallback\Resolver\Simple implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Filesystem\Directory\ReadFactory $readFactory, \Magento\Framework\View\Design\Fallback\RulePool $rulePool)
    {
        $this->___init();
        parent::__construct($readFactory, $rulePool);
    }

    /**
     * {@inheritdoc}
     */
    public function resolve($type, $file, $area = null, \Magento\Framework\View\Design\ThemeInterface $theme = null, $locale = null, $module = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'resolve');
        if (!$pluginInfo) {
            return parent::resolve($type, $file, $area, $theme, $locale, $module);
        } else {
            return $this->___callPlugins('resolve', func_get_args(), $pluginInfo);
        }
    }
}
