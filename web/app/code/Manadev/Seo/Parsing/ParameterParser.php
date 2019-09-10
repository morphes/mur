<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Seo\Configuration;
use Manadev\Seo\Data\ParserData;

abstract class ParameterParser
{
    /**
     * @var SegmentScanner
     */
    protected $segmentScanner;
    /**
     * @var ParsingHelper
     */
    protected $helper;
    /**
     * @var ParserStateFactory
     */
    protected $parserStateFactory;
    /**
     * @var Configuration
     */
    protected $configuration;

    public function __construct(SegmentScanner $segmentScanner, ParsingHelper $helper,
        ParserStateFactory $parserStateFactory, Configuration $configuration)
    {
        $this->segmentScanner = $segmentScanner;
        $this->helper = $helper;
        $this->parserStateFactory = $parserStateFactory;
        $this->configuration = $configuration;
    }

    /**
     * @param string $part
     * @param ParserData $parserState
     * @return ParserData
     */
    abstract public function parse($part, $parserState);
}