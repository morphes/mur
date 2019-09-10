<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo;

use Magento\Framework\App\ViewInterface;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\Core\Contracts\PageType;
use Manadev\Core\Helper;
use Manadev\Seo\Data\CanonicalUrlData;
use Manadev\Seo\Data\RouteData;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\Http as Request;
use Manadev\Seo\Enums\CanonicalOnSecondAndFurtherPage;
use Manadev\Seo\Registries\NoFollowTransformations;
use Manadev\Seo\Registries\NoIndexTransformations;
use Manadev\Seo\Registries\Transformations;
use Magento\Framework\UrlInterface;

class Content
{
    /**
     * @var RouteData
     */
    protected $route;
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Helper
     */
    protected $helper;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var NoIndexTransformations
     */
    protected $noIndexTransformations;
    /**
     * @var NoFollowTransformations
     */
    protected $noFollowTransformations;
    /**
     * @var ViewInterface
     */
    protected $view;
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var UrlInterface
     */
    protected $url;

    public function __construct(RequestInterface $request, Helper $helper, StoreManagerInterface $storeManager,
        NoIndexTransformations $noIndexTransformations, NoFollowTransformations $noFollowTransformations,
        ViewInterface $view, Configuration $configuration, UrlInterface $url)
    {
        $this->request = $request;
        $this->helper = $helper;
        $this->storeManager = $storeManager;
        $this->noIndexTransformations = $noIndexTransformations;
        $this->noFollowTransformations = $noFollowTransformations;
        $this->view = $view;
        $this->configuration = $configuration;
        $this->url = $url;
    }

    /**
     * @param RouteData $route
     * @param null $value
     * @return null|string
     */
    public function noIndex($value = null, $route = null) {
        return $this->transform($this->noIndexTransformations, $route ?: $this->getCurrentRequestRoute(), $value);
    }

    /**
     * @param RouteData $route
     * @param null $value
     * @return null|string
     */
    public function noFollow($value = null, $route = null) {
        return $this->transform($this->noFollowTransformations, $route ?: $this->getCurrentRequestRoute(), $value);
    }

    public function metaTitle($value = null) {
        return $this->render('meta_title', $value);
    }

    public function metaDescription($value = null) {
        return $this->render('meta_description', $value);
    }

    public function metaKeywords($value = null) {
        return $this->render('meta_keywords', $value);
    }


    public function canonicalUrl() {
        $route = clone $this->getCurrentRequestRoute();
        if (!$this->isApplicable($route)) {
            return null;
        }

        $pageType = $this->helper->getPageType($route->path);
        if (!$this->configuration->isCanonicalUrlRenderedOn($pageType->getConfigKey(), $route->store_id)) {
            return null;
        }

        /* @var \Magento\Catalog\Block\Product\ProductList\Toolbar $toolbarBlock */
        if (!($toolbarBlock = $this->view->getLayout()->getBlock('product_list_toolbar'))) {
            return null;
        }

        if (!($parentBlock = $toolbarBlock->getParentBlock())) {
            return null;
        }

        if (!($parentBlock instanceof \Magento\Catalog\Block\Product\ListProduct)) {
            if ($parentBlock instanceof \Magento\Catalog\Block\Category\View) {
                $productListBlock = $parentBlock->getChildBlock('product_list');
            }
            else {
                return null;
            }
        }
        else {
            $productListBlock = $parentBlock;
        }
        /* @var \Magento\Catalog\Block\Product\ListProduct $productListBlock */

        $this->loadProductCollection($productListBlock, $toolbarBlock);
        $page = $toolbarBlock->getCurrentPage();
        $pageCount = $toolbarBlock->getLastPageNum() + 1;

        if (!isset($route->params['_query'])) {
            $route->params['_query'] = [];
        }

        if ($page > 1) {
            $pagingBehavior = $this->configuration->getCanonicalUrlPagingBehavior($route->store_id);
            if ($pagingBehavior == CanonicalOnSecondAndFurtherPage::ON_NON_FILTERED_PAGES_ONLY) {
                if (count($route->params['_query'])) {
                    return null;
                }
            }
            elseif ($pagingBehavior == CanonicalOnSecondAndFurtherPage::ON_ALL_PAGES_EXCEPT_HAVING_TOOLBAR_PARAMETERS)
            {
                foreach (array_keys($route->params['_query']) as $key) {
                    if ($key != 'q' && !isset($this->configuration->getToolbarParameters()[$key])) {
                        return null;
                    }
                }
            }
        }

        $this->removeParametersFromCanonicalUrl($route);

        if ($this->configuration->isCanonicalUrlPointingToAllProducts($route->store_id)) {
            $route->params['_query']['product_list_limit'] = 'all';
        }

        $result = new CanonicalUrlData([
            'canonical' => $this->url->getUrl($route->path, $route->params)
        ]);

        if (!$this->configuration->arePrevAndNextUrlsEnabled($route->store_id)) {
            return $result;
        }

        if ($page > 1) {
            $route->params['_query']['p'] = $page - 1;
            $result->prev = $this->url->getUrl($route->path, $route->params);
        }

        if ($page < $pageCount - 1) {
            $route->params['_query']['p'] = $page + 1;
            $result->next = $this->url->getUrl($route->path, $route->params);
        }

        return $result;
    }

    public function getCurrentRequestRoute() {
        if (!$this->route) {
            $this->route = new RouteData([
                'path' => $this->helper->getCurrentRoute(),
                'params' => $this->getParams(),
                'store_id' => $this->storeManager->getStore()->getId(),
            ]);
        }

        return $this->route;
    }

    /**
     * @param RouteData$route
     * @return bool
     */
    public function isApplicable($route) {
        return $this->helper->getPageType($route->path) != null;
    }

    protected function getParams() {
        $params = $this->request->getUserParams();
        $params['_query'] = $this->request->getQuery()->toArray();
        return $params;
    }

    /**
     * @param Transformations $transformations
     * @param RouteData $route
     * @param mixed $value
     * @return mixed
     */
    protected function transform($transformations, $route, $value = null) {
        if (!$this->isApplicable($route)) {
            return $value;
        }

        $route = clone $route;
        foreach ($transformations->getList() as $transformation) {
            $transformation->transform($route, $value);
        }

        return $value;
    }

    public function render($type, $value = null) {
        if (!$this->isApplicable($this->getCurrentRequestRoute())) {
            return $value;
        }

        /* @var \Manadev\Seo\Blocks\ContentRenderer $renderer */
        $renderer = $this->view->getLayout()->getBlock('manadev_seo_content_renderer');

        $data = $this->getData($type);
        $data['value'] = $value;

        return $renderer->render($this->getTemplate($type), $data);
    }

    public function getTemplate($type) {
        return "Manadev_Seo::$type.phtml";
    }

    public function getData($type) {
        $route = $this->getCurrentRequestRoute();
        $query = isset($route->params['_query']) ? $route->params['_query'] : [];

        $result = [
            'route' => $route->path,
            'params' => $route->params,
            'query' => $query,
        ];

        foreach ($this->configuration->getToolbarParameters() as $parameter => $configKey) {
            if (isset($query[$parameter]) &&
                $this->configuration->isToolbarParameterIncludedIn($type, $configKey, $route->store_id))
            {
                $result[$configKey] = $query[$parameter];
            }
            else {
                $result[$configKey] = null;
            }
        }

        if (isset($query['q']) && $this->configuration->isKeywordParameterIncludedIn($type, $route->store_id)) {
            $result['keyword'] = $query['q'];
        }
        else {
            $result['keyword'] = null;
        }

        return $result;
    }

    /**
     * @param RouteData $route
     */
    public function removeParametersFromCanonicalUrl($route) {
        foreach ($this->configuration->getToolbarParameters() as $parameter => $configKey) {
            if (isset($route->params['_query'][$parameter]) &&
                !$this->configuration->isToolbarParameterIncludedInCanonicalUrl($configKey, $route->store_id))
            {
                unset($route->params['_query'][$parameter]);
            }
        }

        if (isset($query['q']) && !$this->configuration->isKeywordParameterIncludedInCanonicalUrl($route->store_id)) {
            unset($route->params['_query']['q']);
        }
    }

    /**
     * @param \Magento\Catalog\Block\Product\ListProduct $productList
     * @param \Magento\Catalog\Block\Product\ProductList\Toolbar $toolbar
     */
    protected function loadProductCollection($productList, $toolbar) {
        // called prepare sortable parameters
        $collection = $productList->getLoadedProductCollection();

        // use sortable parameters
        $orders = $productList->getAvailableOrders();
        if ($orders) {
            $toolbar->setAvailableOrders($orders);
        }
        $sort = $productList->getSortBy();
        if ($sort) {
            $toolbar->setDefaultOrder($sort);
        }
        $dir = $productList->getDefaultDirection();
        if ($dir) {
            $toolbar->setDefaultDirection($dir);
        }
        $modes = $productList->getModes();
        if ($modes) {
            $toolbar->setModes($modes);
        }

        // set collection to toolbar and apply sort
        $toolbar->setCollection($collection);

        $collection->load();
    }
}