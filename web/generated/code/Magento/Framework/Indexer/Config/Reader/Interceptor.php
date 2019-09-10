<?php
namespace Magento\Framework\Indexer\Config\Reader;

/**
 * Interceptor class for @see \Magento\Framework\Indexer\Config\Reader
 */
class Interceptor extends \Magento\Framework\Indexer\Config\Reader implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Config\FileResolverInterface $fileResolver, \Magento\Framework\Indexer\Config\Converter $converter, \Magento\Framework\Indexer\Config\SchemaLocator $schemaLocator, \Magento\Framework\Config\ValidationStateInterface $validationState, $fileName = 'indexer.xml', $idAttributes = array(), $domDocumentClass = 'Magento\\Framework\\Config\\Dom', $defaultScope = 'global')
    {
        $this->___init();
        parent::__construct($fileResolver, $converter, $schemaLocator, $validationState, $fileName, $idAttributes, $domDocumentClass, $defaultScope);
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
