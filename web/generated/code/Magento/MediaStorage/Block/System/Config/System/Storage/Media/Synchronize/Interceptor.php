<?php
namespace Magento\MediaStorage\Block\System\Config\System\Storage\Media\Synchronize;

/**
 * Interceptor class for @see \Magento\MediaStorage\Block\System\Config\System\Storage\Media\Synchronize
 */
class Interceptor extends \Magento\MediaStorage\Block\System\Config\System\Storage\Media\Synchronize implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\MediaStorage\Model\File\Storage $fileStorage, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $fileStorage, $data);
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
