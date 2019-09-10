<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo;

use Manadev\Core\Profiler;
use Manadev\Seo\Content;
use Manadev\Seo\Generation\UrlGenerator;

class LinkContent
{
    /**
     * @var UrlGenerator
     */
    protected $urlGenerator;
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var Profiler
     */
    protected $profiler;
    /**
     * @var Content
     */
    protected $content;

    public function __construct(UrlGenerator $urlGenerator, Configuration $configuration, Profiler $profiler,
        Content $content)
    {
        $this->urlGenerator = $urlGenerator;
        $this->configuration = $configuration;
        $this->profiler = $profiler;
        $this->content = $content;
    }

    public function noFollow() {
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