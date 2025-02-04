<?php
namespace Magento\CatalogUrlRewrite\Model\CategoryUrlPathGenerator;

/**
 * Proxy class for @see \Magento\CatalogUrlRewrite\Model\CategoryUrlPathGenerator
 */
class Proxy extends \Magento\CatalogUrlRewrite\Model\CategoryUrlPathGenerator implements \Magento\Framework\ObjectManager\NoninterceptableInterface
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Proxied instance name
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Proxied instance
     *
     * @var \Magento\CatalogUrlRewrite\Model\CategoryUrlPathGenerator
     */
    protected $_subject = null;

    /**
     * Instance shareability flag
     *
     * @var bool
     */
    protected $_isShared = null;

    /**
     * Proxy constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @param bool $shared
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Magento\\CatalogUrlRewrite\\Model\\CategoryUrlPathGenerator', $shared = true)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
        $this->_isShared = $shared;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['_subject', '_isShared', '_instanceName'];
    }

    /**
     * Retrieve ObjectManager from global scope
     */
    public function __wakeup()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * Clone proxied instance
     */
    public function __clone()
    {
        $this->_subject = clone $this->_getSubject();
    }

    /**
     * Get proxied instance
     *
     * @return \Magento\CatalogUrlRewrite\Model\CategoryUrlPathGenerator
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = true === $this->_isShared
                ? $this->_objectManager->get($this->_instanceName)
                : $this->_objectManager->create($this->_instanceName);
        }
        return $this->_subject;
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlPath($category)
    {
        return $this->_getSubject()->getUrlPath($category);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlPathWithSuffix($category, $storeId = null)
    {
        return $this->_getSubject()->getUrlPathWithSuffix($category, $storeId);
    }

    /**
     * {@inheritdoc}
     */
    public function getCanonicalUrlPath($category)
    {
        return $this->_getSubject()->getCanonicalUrlPath($category);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlKey($category)
    {
        return $this->_getSubject()->getUrlKey($category);
    }
}
