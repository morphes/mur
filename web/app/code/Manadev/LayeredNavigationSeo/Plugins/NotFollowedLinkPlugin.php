<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Plugins;

use Manadev\Core\Features;
use Manadev\Core\Profiler;
use Manadev\LayeredNavigationSeo\Configuration;
use Manadev\Seo\Content;
use Manadev\Seo\Generation\UrlGenerator;

class NotFollowedLinkPlugin
{
    /**
     * @var Content
     */
    protected $content;
    /**
     * @var UrlGenerator
     */
    protected $urlGenerator;
    /**
     * @var Profiler
     */
    protected $profiler;
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(Content $content, UrlGenerator $urlGenerator, Profiler $profiler,
        Configuration $configuration, Features $features)
    {
        $this->content = $content;
        $this->urlGenerator = $urlGenerator;
        $this->profiler = $profiler;
        $this->configuration = $configuration;
        $this->features = $features;
    }

    public function aroundNoFollow($block, callable $proceed) {
        if (!$this->features->isEnabled(__CLASS__)) {
            return $proceed();
        }

        if (!($route = $this->urlGenerator->getLastOriginalRoute())) {
            return '';
        }

        if (!$this->configuration->isNoFollowAddedToLinks($route->store_id)) {
            return '';
        }

        $this->profiler->start('seo-url-nofollow');

        $html = $this->content->noFollow(null, $route) == 'NOFOLLOW' ? 'rel="nofollow"' : '';

        $this->profiler->stop('seo-url-nofollow');

        return $html;
    }
}