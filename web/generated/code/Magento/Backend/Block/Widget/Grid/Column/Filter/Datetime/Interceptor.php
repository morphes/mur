<?php
namespace Magento\Backend\Block\Widget\Grid\Column\Filter\Datetime;

/**
 * Interceptor class for @see \Magento\Backend\Block\Widget\Grid\Column\Filter\Datetime
 */
class Interceptor extends \Magento\Backend\Block\Widget\Grid\Column\Filter\Datetime implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Context $context, \Magento\Framework\DB\Helper $resourceHelper, \Magento\Framework\Math\Random $mathRandom, \Magento\Framework\Locale\ResolverInterface $localeResolver, \Magento\Framework\Stdlib\DateTime\DateTimeFormatterInterface $dateTimeFormatter, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $resourceHelper, $mathRandom, $localeResolver, $dateTimeFormatter, $data);
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
