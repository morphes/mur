<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Routing;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\Request\Http as Request;
use Magento\Framework\App\Response\Http as Response;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\Core\Features;
use Manadev\Core\Registries\PageTypes;
use Manadev\Seo\Configuration;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Generation\UrlGenerator;
use Manadev\Seo\Parsing\Parser;
use Manadev\Seo\Resources\UrlKeyResource;
use Manadev\Core\Configuration as CoreConfiguration;

class Router implements RouterInterface
{
    /**
     * @var Parser
     */
    protected $parser;
    /**
     * @var ActionFactory
     */
    protected $actionFactory;
    /**
     * @var Response
     */
    protected $response;
    /**
     * @var UrlInterface
     */
    protected $url;
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var UrlGenerator
     */
    protected $urlGenerator;
    /**
     * @var PageTypes
     */
    protected $pageTypes;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var UrlKeyResource
     */
    protected $resource;
    /**
     * @var CoreConfiguration
     */
    protected $coreConfiguration;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(Parser $parser, ActionFactory $actionFactory, ResponseInterface $response,
        UrlInterface $url, Configuration $configuration, UrlGenerator $urlGenerator, PageTypes $pageTypes,
        StoreManagerInterface $storeManager, UrlKeyResource $resource, CoreConfiguration $coreConfiguration,
        Features $features)
    {
        $this->parser = $parser;
        $this->actionFactory = $actionFactory;
        $this->response = $response;
        $this->url = $url;
        $this->configuration = $configuration;
        $this->urlGenerator = $urlGenerator;
        $this->pageTypes = $pageTypes;
        $this->storeManager = $storeManager;
        $this->resource = $resource;
        $this->coreConfiguration = $coreConfiguration;
        $this->features = $features;
    }

    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     * @return ActionInterface
     */
    public function match(RequestInterface $request) {
        /* @var Request $request */

        if (!($result = $this->parser->parse($request))) {
            return null;
        }

        $url = $this->url->getUrl($result->route, array_merge(
            $result->params,
            [ '_query' => $result->query]
        ));

        if ($result->status != UrlKeyStatus::ACTIVE) {
            return $this->redirect($request, $url);
        }

        $route = $this->urlGenerator->getLastRoute();
        if ($this->configuration->isParameterOrderCorrected() && !empty($route->params['_direct']) &&
            urldecode($route->params['_direct']) != $result->alias)
        {
            return $this->redirect($request, $url);
        }

        if ($result->route == 'cms/page/view' && $this->coreConfiguration->getHomePageType() == 'cms' &&
            $this->coreConfiguration->getCmsHomePage() == $result->page_url_key)
        {
            $url = $this->url->getUrl('cms/index/index', [ '_query' => $result->query]);

            return $this->redirect($request, $url);
        }

        return $this->forward($request, $result);
    }

    /**
     * @param Request $request
     * @param $url
     * @return ActionInterface
     */
    protected function redirect(Request $request, $url) {
        $this->response->setRedirect($url, 301);
        $request->setDispatched(true);

        return $this->actionFactory->create('Magento\Framework\App\Action\Redirect');
    }

    /**
     * @param Request $request
     * @param $result
     * @return ActionInterface
     */
    protected function forward(Request $request, $result) {
        $request->setAlias(UrlInterface::REWRITE_REQUEST_PATH_ALIAS, $result->alias);
        $request->setPathInfo('/' . $result->path);
        $request->setQueryValue($result->query);

        return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
    }

}