<?php
namespace Manadev\Seo\Parsing\GeneralUrlSettings;

/**
 * Interceptor class for @see \Manadev\Seo\Parsing\GeneralUrlSettings
 */
class Interceptor extends \Manadev\Seo\Parsing\GeneralUrlSettings implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Manadev\Core\Registries\PageTypes $pageTypes, \Manadev\Seo\Configuration $configuration, \Manadev\Seo\Parsing\ActiveUrlSettings $activeUrlSettings, \Manadev\Seo\Parsing\RedirectedUrlSettings $redirectedUrlSettings)
    {
        $this->___init();
        parent::__construct($pageTypes, $configuration, $activeUrlSettings, $redirectedUrlSettings);
    }

    /**
     * {@inheritdoc}
     */
    public function homePageHasParameters()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'homePageHasParameters');
        if (!$pluginInfo) {
            return parent::homePageHasParameters();
        } else {
            return $this->___callPlugins('homePageHasParameters', func_get_args(), $pluginInfo);
        }
    }
}
