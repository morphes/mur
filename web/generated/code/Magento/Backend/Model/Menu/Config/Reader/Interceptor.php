<?php
namespace Magento\Backend\Model\Menu\Config\Reader;

/**
 * Interceptor class for @see \Magento\Backend\Model\Menu\Config\Reader
 */
class Interceptor extends \Magento\Backend\Model\Menu\Config\Reader implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Config\FileResolverInterface $fileResolver, \Magento\Backend\Model\Menu\Config\Converter $converter, \Magento\Backend\Model\Menu\Config\SchemaLocator $schemaLocator, \Magento\Framework\Config\ValidationStateInterface $validationState, $fileName = 'menu.xml', $idAttributes = array(), $domDocumentClass = 'Magento\\Backend\\Model\\Menu\\Config\\Menu\\Dom', $defaultScope = 'global')
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
