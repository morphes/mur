<?php
namespace Magento\Backend\Block\Widget\Grid\Column\Filter\Country;

/**
 * Interceptor class for @see \Magento\Backend\Block\Widget\Grid\Column\Filter\Country
 */
class Interceptor extends \Magento\Backend\Block\Widget\Grid\Column\Filter\Country implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Framework\DB\Helper $resourceHelper, \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $directoriesFactory, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $resourceHelper, $directoriesFactory, $data);
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
