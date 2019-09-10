<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Seo\Data\ParserData;
use Manadev\Seo\Data\UrlKeyData;
use Manadev\Seo\Enums\UrlKeyStatus;

class ParsingHelper
{
    const NUMERAL = '0123456789';

    protected $failedAttempts = [];

    public function clearFailedAttempts() {
        $this->failedAttempts = [];
    }

    public function isAttemptFailed($attempt) {
        return isset($this->failedAttempts[$attempt]);
    }

    public function markAttemptAsFailed($attempt) {
        $this->failedAttempts[$attempt] = true;
    }

    /**
     * @param ParserData $parserState
     * @param string $key
     * @param string $type
     * @param string $parameterName
     * @return UrlKeyData
     */
    public function findUrlKey($parserState, $key, $type, $parameterName = '') {
        if (empty($parserState->url_keys[$key][$type])) {
            return null;
        }

        foreach ($parserState->url_keys[$key][$type] as $urlKey) {
            /* @var UrlKeyData $urlKey */

            if ($parameterName && $urlKey->param_name != $parameterName) {
                continue;
            }

            if ($parserState->settings->status != UrlKeyStatus::ACTIVE) {
                return $urlKey;
            }

            if ($urlKey->status == UrlKeyStatus::ACTIVE) {
                return $urlKey;
            }
        }

        return null;
    }

    public function isPlaceholder($text, $pos) {
        return $pos + 5 <= mb_strlen($text) &&
            mb_strpos($text, '__', $pos) === $pos &&
            strpos(static::NUMERAL, mb_substr($text, $pos + 2, 1)) !== false &&
            mb_strpos($text, '__', $pos + 3) === $pos + 3;
    }
}