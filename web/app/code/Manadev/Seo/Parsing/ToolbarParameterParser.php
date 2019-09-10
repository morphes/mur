<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Seo\Data\ParserData;

class ToolbarParameterParser extends ParameterParser
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

        $parserState->parameter_value = mb_substr($parserState->path, $parserState->path_pos, $parserState->path_length);
        return $parserState;
    }
}