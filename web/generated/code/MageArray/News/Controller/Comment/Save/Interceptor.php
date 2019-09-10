<?php
namespace MageArray\News\Controller\Comment\Save;

/**
 * Interceptor class for @see \MageArray\News\Controller\Comment\Save
 */
class Interceptor extends \MageArray\News\Controller\Comment\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder, \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation, \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remoteAddress, \MageArray\News\Model\Customerdata $customerdata, \Magento\Framework\Escaper $escaper, \MageArray\News\Helper\Data $dataHelper, \MageArray\News\Model\NewspostFactory $newspostFactory, \MageArray\News\Model\NewscommentFactory $newscommentFactory)
    {
        $this->___init();
        parent::__construct($context, $scopeConfig, $transportBuilder, $inlineTranslation, $remoteAddress, $customerdata, $escaper, $dataHelper, $newspostFactory, $newscommentFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
