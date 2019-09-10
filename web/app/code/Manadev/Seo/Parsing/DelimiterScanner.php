<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Seo\Data\Parser\TokenData;
use Manadev\Seo\Data\ParserData;

class DelimiterScanner
{
    /**
     * @param ParserData $parserState
     * @return TokenData[]
     */
    public function scan($parserState) {
        $result = [];

        for ($pos = 0; $pos < $parserState->path_length; $pos++) {
            foreach ($parserState->settings->all_delimiters as $delimiter) {
                if (mb_strpos($parserState->path, $delimiter, $pos) !== $pos) {
                    continue;
                }

                $result[] = new TokenData([
                    'text' => $delimiter,
                    'pos' => $pos,
                    'length' => mb_strlen($delimiter),
                ]);
            }
        }

        return $result;
    }
}