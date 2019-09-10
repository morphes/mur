<?php
namespace Manadev\Seo\Content;

/**
 * Interceptor class for @see \Manadev\Seo\Content
 */
class Interceptor extends \Manadev\Seo\Content implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\RequestInterface $request, \Manadev\Core\Helper $helper, \Magento\Store\Model\StoreManagerInterface $storeManager, \Manadev\Seo\Registries\NoIndexTransformations $noIndexTransformations, \Manadev\Seo\Registries\NoFollowTransformations $noFollowTransformations, \Magento\Framework\App\ViewInterface $view, \Manadev\Seo\Configuration $configuration, \Magento\Framework\UrlInterface $url)
    {
        $this->___init();
        parent::__construct($request, $helper, $storeManager, $noIndexTransformations, $noFollowTransformations, $view, $configuration, $url);
    }

    /**
     * {@inheritdoc}
     */
    public function isApplicable($route)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isApplicable');
        if (!$pluginInfo) {
            return parent::isApplicable($route);
        } else {
            return $this->___callPlugins('isApplicable', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate($type)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTemplate');
        if (!$pluginInfo) {
            return parent::getTemplate($type);
        } else {
            return $this->___callPlugins('getTemplate', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getData($type)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getData');
        if (!$pluginInfo) {
            return parent::getData($type);
        } else {
            return $this->___callPlugins('getData', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeParametersFromCanonicalUrl($route)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'removeParametersFromCanonicalUrl');
        if (!$pluginInfo) {
            return parent::removeParametersFromCanonicalUrl($route);
        } else {
            return $this->___callPlugins('removeParametersFromCanonicalUrl', func_get_args(), $pluginInfo);
        }
    }
}
