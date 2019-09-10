<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Core\Helper;
use Manadev\Seo\Data\Parser\TokenData;
use Manadev\Seo\Data\ParserData;
use Manadev\Seo\Data\UrlKeyData;
use Manadev\Seo\Resources\UrlKeyResource;

class KeyScanner
{
    const MAX_URL_KEYS_IN_ONE_SEARCH = 1000;

    /**
     * @var Helper
     */
    protected $helper;
    /**
     * @var UrlKeyResource
     */
    protected $urlKeyResource;
    /**
     * @var SegmentScanner
     */
    protected $segmentScanner;

    public function __construct(Helper $helper, UrlKeyResource $urlKeyResource, SegmentScanner $segmentScanner) {
        $this->helper = $helper;
        $this->urlKeyResource = $urlKeyResource;
        $this->segmentScanner = $segmentScanner;
    }

    /**
     * @param ParserData $parserState
     * @return TokenData[]
     */
    public function scan($parserState) {
        $result = [];

        foreach ($this->helper->iterateInChunks($this->segmentScanner->scan($parserState),
            static::MAX_URL_KEYS_IN_ONE_SEARCH) as $segments)
        {
            $candidates = array_unique(array_map(function($segment) { return $segment->text; }, $segments));

            foreach ($this->urlKeyResource->find($candidates, $parserState->store_id) as $record) {
                $record = new UrlKeyData($record);

                if (!isset($result[$record->url_key])) {
                    $result[$record->url_key] = [];
                }

                if (!isset($result[$record->url_key][$record->type])) {
                    $result[$record->url_key][$record->type] = [];
                }

                if (!isset($result[$record->url_key][$record->type][$record->id])) {
                    $result[$record->url_key][$record->type][$record->id] = $record;
                }
            }
        }

        return $result;
    }
}