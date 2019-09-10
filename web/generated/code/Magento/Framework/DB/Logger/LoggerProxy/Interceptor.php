<?php
namespace Magento\Framework\DB\Logger\LoggerProxy;

/**
 * Interceptor class for @see \Magento\Framework\DB\Logger\LoggerProxy
 */
class Interceptor extends \Magento\Framework\DB\Logger\LoggerProxy implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\DB\Logger\FileFactory $fileFactory, \Magento\Framework\DB\Logger\QuietFactory $quietFactory, $loggerAlias, $logAllQueries = true, $logQueryTime = 0.001, $logCallStack = true)
    {
        $this->___init();
        parent::__construct($fileFactory, $quietFactory, $loggerAlias, $logAllQueries, $logQueryTime, $logCallStack);
    }

    /**
     * {@inheritdoc}
     */
    public function logStats($type, $sql, $bind = array(), $result = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'logStats');
        if (!$pluginInfo) {
            return parent::logStats($type, $sql, $bind, $result);
        } else {
            return $this->___callPlugins('logStats', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function startTimer()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'startTimer');
        if (!$pluginInfo) {
            return parent::startTimer();
        } else {
            return $this->___callPlugins('startTimer', func_get_args(), $pluginInfo);
        }
    }
}
