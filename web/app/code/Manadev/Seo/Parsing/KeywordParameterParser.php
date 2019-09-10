<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Seo\Data\ParserData;

class KeywordParameterParser extends ParameterParser
{
    /**
     * @param string $part
     * @param ParserData $parserState
     * @return ParserData
     */
    public function parse($part, $parserState) {
        if (!$parserState->path_length) {
            return null;
        }

        if ($parserState->route != 'catalogsearch/result/index') {
            return null;
        }

        if ($this->configuration->getKeywordParameterUrlPart() != $part) {
            return null;
        }

        if ($this->configuration->isKeywordParameterUsingParameterUrlKey() && !$parserState->parameter_name) {
            return null;
        }

        if (isset($parserState->{$part . '_parameters'}['q'])) {
            return null;
        }

        $parserState->parameter_name = 'q';
        $parserState->parameter_value = urldecode(
            mb_substr($parserState->path, $parserState->path_pos, $parserState->path_length));
        return $parserState;
    }
}