<?php
namespace Magento\Framework\App\Route\Config\Reader;

/**
 * Interceptor class for @see \Magento\Framework\App\Route\Config\Reader
 */
class Interceptor extends \Magento\Framework\App\Route\Config\Reader implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Config\FileResolverInterface $fileResolver, \Magento\Framework\App\Route\Config\Converter $converter, \Magento\Framework\App\Route\Config\SchemaLocator $schemaLocator, \Magento\Framework\Config\ValidationStateInterface $validationState, $fileName = 'routes.xml')
    {
        $this->___init();
        parent::__construct($fileResolver, $converter, $schemaLocator, $validationState, $fileName);
    }

    /**
     * {@inheritdoc}
     */
    public function read($scope = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'read');
        if (!$pluginInfo) {
            return parent::read($scope);
        } else {
            return $this->___callPlugins('read', func_get_args(), $pluginInfo);
        }
    }
}
