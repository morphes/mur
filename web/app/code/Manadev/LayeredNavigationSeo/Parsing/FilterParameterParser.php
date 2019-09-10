<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Parsing;

use Manadev\LayeredNavigation\RequestParser;
use Manadev\LayeredNavigation\UrlSettings;
use Manadev\Seo\Configuration;
use Manadev\Seo\Helper;
use Manadev\Seo\Parsing\ParameterParser;
use Manadev\Seo\Parsing\ParserStateFactory;
use Manadev\Seo\Parsing\ParsingHelper;
use Manadev\Seo\Parsing\SegmentScanner;

abstract class FilterParameterParser extends ParameterParser
{
    /**
     * @var RequestParser
     */
    protected $requestParser;

    /**
     * @var UrlSettings
     */
    protected $urlSettings;

    public function __construct(SegmentScanner $segmentScanner, ParsingHelper $helper,
        ParserStateFactory $parserStateFactory, Configuration $configuration,
        RequestParser $requestParser, UrlSettings $urlSettings)
    {
        parent::__construct($segmentScanner, $helper, $parserStateFactory, $configuration);
        $this->requestParser = $requestParser;
        $this->urlSettings = $urlSettings;
    }
}