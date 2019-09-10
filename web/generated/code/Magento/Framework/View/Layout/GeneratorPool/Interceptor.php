<?php
namespace Magento\Framework\View\Layout\GeneratorPool;

/**
 * Interceptor class for @see \Magento\Framework\View\Layout\GeneratorPool
 */
class Interceptor extends \Magento\Framework\View\Layout\GeneratorPool implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Layout\ScheduledStructure\Helper $helper, \Magento\Framework\View\Layout\Condition\ConditionFactory $conditionFactory, \Psr\Log\LoggerInterface $logger, array $generators = null)
    {
        $this->___init();
        parent::__construct($helper, $conditionFactory, $logger, $generators);
    }

    /**
     * {@inheritdoc}
     */
    public function process(\Magento\Framework\View\Layout\Reader\Context $readerContext, \Magento\Framework\View\Layout\Generator\Context $generatorContext)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'process');
        if (!$pluginInfo) {
            return parent::process($readerContext, $generatorContext);
        } else {
            return $this->___callPlugins('process', func_get_args(), $pluginInfo);
        }
    }
}
