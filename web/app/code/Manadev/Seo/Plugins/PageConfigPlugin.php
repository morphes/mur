<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Plugins;

use Magento\Framework\View\Page\Config;
use Manadev\Core\Features;
use Manadev\Core\Profiler;
use Manadev\Seo\Content;
use Magento\Framework\App\ViewInterface;
use Magento\CatalogSearch\Helper\Data;

class PageConfigPlugin
{
    protected $transformed = false;
    /**
     * @var Content
     */
    protected $content;
    /**
     * @var Profiler
     */
    protected $profiler;
    /**
     * @var Features
     */
    protected $features;
    protected $catalogSearchData;

    /**
     * @var ViewInterface
     */
    protected $view;

    public function __construct(
        Content $content, Profiler $profiler, Features $features, ViewInterface $view, Data $catalogSearchData
    ) {
        $this->content = $content;
        $this->profiler = $profiler;
        $this->catalogSearchData = $catalogSearchData;
        $this->features = $features;
        $this->view = $view;
    }

    public function afterGetMetadata(Config $config, $metadata) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $metadata;
        }

        if (!$this->transformed) {
            $this->transformRobots($config, $metadata);

            $this->profiler->start('seo-meta-title');
            if ($title = $this->content->metaTitle($config->getTitle()->getShortHeading())) {
                $this->preventSearchResultFromDisplayingAlteredMetaTitle($config->getTitle()->getShortHeading());
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $product = $objectManager->get('Magento\Framework\Registry')->registry('current_product');
                $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
                $id = $storeManager->getStore()->getId();
                if($id == 3 && $product && $product->getName() != $product->getSku()) {
                    $config->getTitle()->set($title . '| ' . $product->getSku());
                }
            }
            $queryText = $this->catalogSearchData->getEscapedQueryText();
            if($queryText) {
                $config->getTitle()->set(__("Search results for: '%1'", $this->catalogSearchData->getEscapedQueryText()));
            }
            
            $this->profiler->stop('seo-meta-title');

            $this->profiler->start('seo-meta-description');
            if ($description = $this->content->metaDescription($metadata['description'])) {
                $config->setMetadata('description', $description);
            }
            $this->profiler->stop('seo-meta-description');

            $this->profiler->start('seo-meta-keywords');
            if ($keywords = $this->content->metaKeywords($metadata['keywords'])) {
                $config->setMetadata('keywords', $keywords);
            }
            $this->profiler->stop('seo-meta-keywords');

            $this->profiler->start('seo-canonical');
            if ($canonical = $this->content->canonicalUrl()) {
                $this->clearAssetGroup($config, 'canonical');
                $config->addRemotePageAsset($canonical->canonical, 'canonical', ['attributes' => ['rel' => 'canonical']]);

                if ($canonical->prev) {
                    $this->clearAssetGroup($config, 'prev');
                    $config->addRemotePageAsset($canonical->prev, 'prev', ['attributes' => ['rel' => 'prev']]);
                }

                if ($canonical->next) {
                    $this->clearAssetGroup($config, 'next');
                    $config->addRemotePageAsset($canonical->next, 'next', ['attributes' => ['rel' => 'next']]);
                }
            }
            $this->profiler->stop('seo-canonical');

            $this->transformed = true;
        }

        return $metadata;
    }

    protected function transformRobots(Config $config, &$metadata) {
        $this->profiler->start('seo-robots');
        $instructions = $metadata['robots'] ? explode(',', strtoupper($metadata['robots'])) : [];
        $noIndex = 'INDEX';
        $noFollow = 'FOLLOW';

        foreach (array_keys($instructions) as $key) {
            switch ($instructions[$key]) {
                case "INDEX":
                case "NOINDEX":
                    $noIndex = $instructions[$key];
                    unset($instructions[$key]);
                    break;
                case "FOLLOW":
                case "NOFOLLOW":
                    $noFollow = $instructions[$key];
                    unset($instructions[$key]);
                    break;
            }
        }

        if ($noFollow = $this->content->noFollow($noFollow)) {
            array_unshift($instructions, $noFollow);
        }

        if ($noIndex = $this->content->noIndex($noIndex)) {
            array_unshift($instructions, $noIndex);
        }

        $metadata['robots'] = implode(',', $instructions);
        $config->setMetadata('robots', $metadata['robots']);
        $this->profiler->stop('seo-robots');
    }

    protected function clearAssetGroup(Config $config, $contentType) {
        if (!($group = $config->getAssetCollection()->getGroupByContentType($contentType))) {
            return;
        }

        foreach ($group->getAll() as $asset) {
            /* @var \Magento\Framework\View\Asset\Remote $asset */
            $config->getAssetCollection()->remove($asset->getUrl());
        }
    }

    protected function preventSearchResultFromDisplayingAlteredMetaTitle($unalteredMetaTitle) {
        $block = $this->view->getLayout()->getBlock('page.main.title');
        if (!($block = $this->view->getLayout()->getBlock('search.result'))) {
            // if there is no search result block on the page, do nothing
            return;
        }

        if (!($block = $this->view->getLayout()->getBlock('page.main.title'))) {
            // if there is no page main title block on the page, do nothing
            return;
        }
        /* @var \Magento\Theme\Block\Html\Title $block */
        $block->setPageTitle($unalteredMetaTitle);
    }
}