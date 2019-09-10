<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Seo\Data\Parser\TokenData;
use Manadev\Seo\Data\ParserData;

class SegmentScanner
{
    /** @noinspection PhpInconsistentReturnPointsInspection */
    /**
     * @param ParserData $parserState
     * @param bool|\string[] $fromDelimiters
     * @param bool|\string[] $toDelimiters
     * @return TokenData[]
     */
    public function scan($parserState, $fromDelimiters = false, $toDelimiters = false) {

        foreach ($this->scanFrom($parserState, $parserState->path_pos, false, $toDelimiters) as $segment) {
            yield $segment;
        }

        $scannedFrom = [$parserState->path_pos => true];

        foreach ($parserState->delimiters as $delimiter) {
            $from = $delimiter->pos + $delimiter->length;

            if ($fromDelimiters !== false && !isset($fromDelimiters[$delimiter->text])) {
                continue;
            }

            if ($from < $parserState->path_pos) {
                continue;
            }

            if (isset($scannedFrom[$from])) {
                continue;
            }

            $scannedFrom[$from] = true;

            foreach ($this->scanFrom($parserState, $from, $delimiter, $toDelimiters) as $segment) {
                yield $segment;
            }
        }
    }

    /**
     * @param ParserData $parserState
     * @param int $from
     * @param TokenData|false $delimiterBefore
     * @param string[]|false $toDelimiters
     * @return \Generator|TokenData[]
     */
    protected function scanFrom($parserState, $from, $delimiterBefore, $toDelimiters) {
        $scannedTo = [];
        $to = $parserState->path_pos + $parserState->path_length;

        foreach ($parserState->delimiters as $delimiter) {
            if ($toDelimiters !== false && !isset($toDelimiters[$delimiter->text])) {
                continue;
            }

            if ($delimiter->pos >= $to) {
                continue;
            }

            if (isset($scannedTo[$delimiter->pos])) {
                continue;
            }

            $scannedTo[$delimiter->pos] = true;

            if ($from >= $delimiter->pos) {
                continue;
            }

            foreach ($this->scanSegment($parserState, $from, $delimiterBefore, $delimiter->pos, $delimiter)
                as $segment)
            {
                yield $segment;
            }
        }

        foreach ($this->scanSegment($parserState, $from, $delimiterBefore, $to, false) as $segment)
        {
            yield $segment;
        }

    }

    /**
     * @param ParserData $parserState
     * @param int $from
     * @param TokenData|false $delimiterBefore
     * @param int $to
     * @param TokenData|false $delimiterAfter
     * @return \Generator|TokenData[]
     */
    protected function scanSegment($parserState, $from, $delimiterBefore, $to, $delimiterAfter) {
        $scannedLength = [];

        foreach ($parserState->extensions as $extension) {
            $length = $to <= $extension->pos
                ? $to - $from
                : $extension->pos - $from;

            if ($length <= 0) {
                continue;
            }

            if (isset($scannedLength[$length])) {
                continue;
            }

            $scannedLength[$length] = true;

            yield new TokenData([
                'text' => mb_substr($parserState->path, $from, $length),
                'pos' => $from,
                'length' => $length,
                'delimiter_before' => $delimiterBefore,
                'delimiter_after' => $delimiterAfter,
            ]);
        }
    }

}