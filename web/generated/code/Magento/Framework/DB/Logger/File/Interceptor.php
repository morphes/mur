<?php
namespace Magento\Framework\DB\Logger\File;

/**
 * Interceptor class for @see \Magento\Framework\DB\Logger\File
 */
class Interceptor extends \Magento\Framework\DB\Logger\File implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Filesystem $filesystem, $debugFile = 'debug/db.log', $logAllQueries = false, $logQueryTime = 0.05, $logCallStack = false)
    {
        $this->___init();
        parent::__construct($filesystem, $debugFile, $logAllQueries, $logQueryTime, $logCallStack);
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
