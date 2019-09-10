<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Routing;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Manadev\Core\Contracts\PageType;
use Magento\Framework\App\Request\Http as Request;

class EarlyRouter extends Router
{
    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     * @return ActionInterface
     * @throws UrlConflictException
     */
    public function match(RequestInterface $request) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return null;
        }

        /* @var Request $request */

        if ($request->getPathInfo() != $request->getOriginalPathInfo()) {
            return null;
        }

        if ($result = $this->redirectNonSeoUrl($request)) {
            return $result;
        }

        if (!$this->configuration->areQueryParametersRedirectedToPathParameters()) {
            return null;
        }

        return parent::match($request);
    }

    protected function redirectNonSeoUrl(Request $request) {
        if (!$this->configuration->areNonSeoUrlsRedirectedToSeoOnes()) {
            return null;
        }

        $path = trim($request->getPathInfo(), '/');

        foreach ($this->pageTypes->getList() as $pageType) {
            if (is_null($params = $this->getPathParams($path, $pageType))) {
                continue;
            }

            if (($params = $this->convertParamsToArray($params)) === null) {
                continue;
            }

            $url = $this->url->getUrl($pageType->getRoute(), array_merge(
                $params,
                [ '_query' => $request->getQuery()->toArray()]
            ));

            return $this->redirect($request, $url);
        }

        return null;
    }

    /**
     * @param string $path
     * @param PageType $pageType
     *
     * @return string|null
     */
    protected function getPathParams($path, $pageType) {
        $route = $pageType->getRoute();

        if (mb_strpos($path, $route) === 0) {
            return mb_substr($path, mb_strlen($route));
        }

        if (mb_strrpos($route, '/index') !== mb_strlen($route) - mb_strlen('/index')) {
            return null;
        }

        $route = mb_substr($route, 0, mb_strlen($route) - mb_strlen('/index'));

        if (mb_strpos($path, $route) === 0) {
            return mb_substr($path, mb_strlen($route));
        }

        return null;
    }

    /**
     * @param string $params
     * @return array|null
     */
    protected function convertParamsToArray($params) {
        $params = ltrim($params, '/');
        $params = $params ? explode('/', $params) : [];
        if (count($params) % 2 != 0) {
            return null;
        }

        $result = [];
        for ($i = 0; $i < count($params) / 2; $i++) {
            $result[$params[2 * $i]] = $params[2 * $i + 1];
        }

        return $result;
    }

}