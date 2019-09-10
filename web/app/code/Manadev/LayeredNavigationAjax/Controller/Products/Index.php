<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationAjax\Controller\Products;

use Magento\Framework\App\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Request\Http as Request;
use Magento\Framework\App\Response\Http as Response;
use Magento\Framework\Controller\Result\Forward;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Registry;
use Manadev\LayeredNavigationAjax\Configuration;
use Magento\Framework\View\Layout;
use Manadev\LayeredNavigationAjax\Helper;
use Zend\Stdlib\Parameters;
use Magento\Framework\View\Page\Config as PageConfig;

/**
 * @property Request $_request
 */
class Index extends Action\Action
{
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var ForwardFactory
     */
    protected $forwardFactory;
    /**
     * @var Registry
     */
    protected $registry;
    /**
     * @var Helper
     */
    protected $helper;
    /**
     * @var PageConfig
     */
    protected $pageConfig;

    public function __construct(Context $context, Configuration $configuration, ForwardFactory $forwardFactory,
        Registry $registry, Helper $helper, PageConfig $pageConfig)
    {
        parent::__construct($context);
        $this->configuration = $configuration;
        $this->forwardFactory = $forwardFactory;
        $this->registry = $registry;
        $this->helper = $helper;
        $this->pageConfig = $pageConfig;
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute() {
        $queryParams = $this->_request->getQuery()->toArray();

        $route = str_replace('_', '/', $queryParams['_route']);
        unset($queryParams['_route']);

        $params = [];
        $query = [];
        $queryString = '';
        ksort($queryParams);
        foreach ($queryParams as $key => $value) {
            if (strpos($key, '_') === 0) {
                $params[substr($key, 1)] = $value;
            }
            else {
                $query[$key]  = $value;
                if ($queryString) {
                    $queryString .= '&';
                }
                $queryString .= "$key=$value";
            }
        }

        $this->_request->setQuery(new Parameters());

        $categoryChanged = $this->redirectToSubCategory($route, $params, $query);

        $this->registry->register('mana_layout_output_callback', function(Layout $layout)
            use ($categoryChanged, $route, $params, $query, $queryString)
        {
            if (!($interceptor = $layout->getBlock('mana.layered-nav.ajax.interceptor'))) {
                return null;
            }

            $blockNames = $categoryChanged
                ? $interceptor->getData('blocks_refreshed_after_category_change')
                : $interceptor->getData('blocks_refreshed_staying_in_same_category');
            if (!$blockNames) {
                return null;
            }

            $this->pageConfig->getMetadata();
            $sections = [];
            $json = [
                'blocks' => [],
                'query' => strtr($queryString, ' ', '+'),
                'url' => $this->_url->getUrl($route, array_merge($params, [ '_query' => $query])),
                'title' => $this->pageConfig->getTitle()->get(),
            ];

            foreach (array_map('trim', explode(',', $blockNames)) as $blockName) {
                if (!$layout->getBlock($blockName) && !$layout->isContainer($blockName)) {
                    continue;
                }

                if (!($output = trim($layout->renderElement($blockName)))) {
                    $output = '';
                }

                if (!($selector = $this->getSelector($blockName))) {
                    continue;
                }

                $json['blocks'][$selector] = count($sections);
                $sections[] = $output;
            }

            array_unshift($sections, json_encode($json));

            return implode($this->getSectionSeparator(), $sections);
        }, true);
        return $this->forward($route, $params, $query);
    }

    protected function redirectToSubCategory(&$route, &$params, &$query) {
        $result = false;
        if (isset($params['category_changed'])) {
            $result = (bool)$params['category_changed'];
            unset($params['category_changed']);
        }

        if (!$this->configuration->isCategoryFilterRedirectedToSubcategoryPage()) {
            return false;
        }

        if ($route != 'catalog/category/view' && $route != 'cms/index/index') {
            return false;
        }

        if (!isset($query['cat'])) {
            return $result;
        }

        if (mb_strpos($query['cat'], '_') !== false) {
            return false;
        }

        $route = 'catalog/category/view';
        $params = ['id' => $query['cat']];
        unset($query['cat']);

        return true;
    }

    /**
     * @param $route
     * @param $params
     * @param $query
     */
    protected function forward($route, $params, $query) {
        /* @var Request $request */
        $request = $this->_request;

        $request->setQueryValue($query);

        $url = $this->_url->getUrl($route, array_merge($params, [
            '_use_rewrite' => true,
            '_query' => $query,
            '_escape' => true,
        ]));
        $request->setRequestUri(mb_substr($url, mb_strlen($this->getBaseUrl($request))));

        list($module, $controller, $action) = explode('/', $route);
        $this->_forward($action, $controller, $module, $params);
    }

    protected function getSectionSeparator() {
        return "\n91b5970cd70e2353d866806f8003c1cd56646961\n";
    }

    protected function getSelector($blockName) {
        return '#' . $this->helper->getBlockWrapperId($blockName);
    }

    /**
     * @param Request $request
     * @return string
     */
    protected function getBaseUrl($request) {
        $httpHostWithPort = $request->getHttpHost(false);
        $httpHostWithPort = explode(':', $httpHostWithPort);
        $httpHost = isset($httpHostWithPort[0]) ? $httpHostWithPort[0] : '';
        $port = '';
        if (isset($httpHostWithPort[1])) {
            $defaultPorts = [
                \Magento\Framework\App\Request\Http::DEFAULT_HTTP_PORT,
                \Magento\Framework\App\Request\Http::DEFAULT_HTTPS_PORT,
            ];
            if (!in_array($httpHostWithPort[1], $defaultPorts)) {
                /** Custom port */
                $port = ':' . $httpHostWithPort[1];
            }
        }
        return $request->getScheme() . '://' . $httpHost . $port;
    }
}