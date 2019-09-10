<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Routing;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\Http as Request;

class LateRouter extends Router
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

        if ($this->configuration->areQueryParametersRedirectedToPathParameters()) {
            return null;
        }

        return parent::match($request);
    }

}