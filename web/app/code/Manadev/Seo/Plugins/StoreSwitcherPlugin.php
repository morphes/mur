<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Plugins;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Url\Helper\Data as UrlHelper;
use Magento\Store\Block\Switcher;
use Magento\Store\Model\Store;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\RequestInterface;
use Manadev\Core\Features;
use Manadev\Core\Helper;
use Magento\Framework\App\Request\Http as Request;

class StoreSwitcherPlugin
{
    /**
     * @var UrlHelper
     */
    protected $urlHelper;
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Helper
     */
    protected $helper;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(UrlHelper $urlHelper, UrlInterface $urlBuilder, RequestInterface $request,
        Helper $helper, Features $features)
    {
        $this->urlHelper = $urlHelper;
        $this->urlBuilder = $urlBuilder;
        $this->request = $request;
        $this->helper = $helper;
        $this->features = $features;
    }

    public function beforeGetTargetStorePostData(Switcher $switcher, Store $store, $data = []) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return [$store, $data];
        }

        if (!isset($data[ActionInterface::PARAM_NAME_URL_ENCODED])) {
            return [$store, $data];
        }

        $url = $this->urlBuilder->getUrl($this->helper->getCurrentRoute(), array_merge(
            $this->request->getUserParams(),
            ['_store' => $store->getId()],
            [ '_query' => $this->request->getQuery()->toArray()]
        ));

        $data[ActionInterface::PARAM_NAME_URL_ENCODED] = $this->urlHelper->getEncodedUrl($url);

        return [$store, $data];
    }

}