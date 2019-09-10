<?php
namespace MageArray\News\Block\Adminhtml\Newscat\Edit\Tab\Form;

/**
 * Interceptor class for @see \MageArray\News\Block\Adminhtml\Newscat\Edit\Tab\Form
 */
class Interceptor extends \MageArray\News\Block\Adminhtml\Newscat\Edit\Tab\Form implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \MageArray\News\Helper\Data $newscatHelper, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Store\Model\System\Store $systemStore, \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory $fieldFactory, \MageArray\News\Model\Status $status, \MageArray\News\Model\Categories $categories, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $newscatHelper, $registry, $formFactory, $systemStore, $fieldFactory, $status, $categories, $data);
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
