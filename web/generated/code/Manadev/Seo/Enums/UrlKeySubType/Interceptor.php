<?php
namespace Manadev\Seo\Enums\UrlKeySubType;

/**
 * Interceptor class for @see \Manadev\Seo\Enums\UrlKeySubType
 */
class Interceptor extends \Manadev\Seo\Enums\UrlKeySubType implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct()
    {
        $this->___init();
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterTypes()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getParameterTypes');
        if (!$pluginInfo) {
            return parent::getParameterTypes();
        } else {
            return $this->___callPlugins('getParameterTypes', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOptionTypes()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getOptionTypes');
        if (!$pluginInfo) {
            return parent::getOptionTypes();
        } else {
            return $this->___callPlugins('getOptionTypes', func_get_args(), $pluginInfo);
        }
    }
}
