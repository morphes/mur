<?php
namespace Bss\AdminActionLog\Block\Adminhtml\Detail\Action;

/**
 * Interceptor class for @see \Bss\AdminActionLog\Block\Adminhtml\Detail\Action
 */
class Interceptor extends \Bss\AdminActionLog\Block\Adminhtml\Detail\Action implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\App\Request\Http $request, \Magento\User\Model\UserFactory $userFactory, \Bss\AdminActionLog\Model\ActionGridFactory $actionFactory, \Bss\AdminActionLog\Model\ResourceModel\ActionDetail\CollectionFactory $actionDetailCollectionFactory, \Bss\AdminActionLog\Convert\FineDiffFactory $convert, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $request, $userFactory, $actionFactory, $actionDetailCollectionFactory, $convert, $data);
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
