<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Parsing;

use Manadev\Seo\Data\ParserData;

class RangeFilterParameterParser extends FilterParameterParser
{
    const NUMERAL = '0123456789';
    const NUMERAL_AND_POINT = '0123456789.';

    /**
     * @param string $part
     * @param ParserData $parserState
     * @return ParserData
     */
    public function parse($part, $parserState) {
        if (!$parserState->path_length) {
            return null;
        }

        $rangeDelimiterMethod = "get" . ucfirst($part) . "RangeDelimiter";

        $ranges = $this->scan(mb_substr($parserState->path, $parserState->path_pos, $parserState->path_length),
            $this->configuration->$rangeDelimiterMethod(), $parserState->settings->{$part . '_option_delimiters'});

        if (!$ranges) {
            return null;
        }

        if (empty($parserState->parameter_value)) {
            $parserState->parameter_value = '';
        }

        $result = $parserState;

        foreach ($ranges as $range) {
            if ($result->parameter_value) {
                $result->parameter_value .= $this->urlSettings->getMultipleValueSeparator();
            }
            $result->parameter_value .= implode($this->urlSettings->getRangeSeparator(), $range);
        }

        return $result;
    }

    public function scan($text, $rangeDelimiters, $multipleValueDelimiters) {
        if (!is_array($rangeDelimiters)) {
            $rangeDelimiters = [$rangeDelimiters];
        }
        if (!is_array($multipleValueDelimiters)) {
            $multipleValueDelimiters = [$multipleValueDelimiters];
        }

        $numberRegex = $this->urlSettings->getNumberPattern();
        $endsWithDash = mb_strrpos($text, '-') === mb_strlen($text) - 1;
        if (!($numberCount = preg_match_all($numberRegex, $text))) {
            return false;
        }

        $evenNumberCount = $numberCount % 2 == 0;
        $result = [];
        $pos = 0;
        $length = mb_strlen($text);
        $expectDelimiter = false;

        if ($endsWithDash && $evenNumberCount || !$endsWithDash && !$evenNumberCount) {
            if (!$this->scanDelimiter($text, $pos, $rangeDelimiters)) {
                return false;
            }

            $result[] = ['', $this->scanNumber($text, $pos)];
            $expectDelimiter = true;
        }

        while ($pos < $length) {
            $lastPos = $pos;

            if ($expectDelimiter && !$this->scanDelimiter($text, $pos, $multipleValueDelimiters)) {
                $pos = $lastPos;
                break;
            }

            if (($from = $this->scanNumber($text, $pos)) === false) {
                $pos = $lastPos;
                break;
            }

            if (!$this->scanDelimiter($text, $pos, $rangeDelimiters)) {
                $pos = $lastPos;
                break;
            }

            if (($to = $this->scanNumber($text, $pos)) === false) {
                $pos = $lastPos;
                break;
            }

            if (is_numeric($from) && is_numeric($to) && (float)$to < (float)$from) {
                $result[] = [$to, $from];
            }
            else {
                $result[] = [$from, $to];
            }

            $expectDelimiter = true;
        }

        if ($endsWithDash) {
            $this->scanDelimiter($text, $pos, $multipleValueDelimiters);
            $result[] = [$this->scanNumber($text, $pos), ''];

            if (!$this->scanDelimiter($text, $pos, $rangeDelimiters)) {
                return false;
            }
        }

        if ($pos < $length) {
            return false;
        }

        return $result;
    }

    protected function scanDelimiter($text, &$pos, $delimiters) {
        foreach ($delimiters as $delimiter) {
            if (mb_strpos($text, $delimiter, $pos) === $pos) {
                $pos += mb_strlen($delimiter);
                return true;
            }
        }

        return false;
    }

    protected function scanNumber($text, &$pos) {
        $length = mb_strlen($text);
        if ($pos >= $length) {
            return false;
        }

        if ($this->helper->isPlaceholder($text, $pos)) {
            $result = mb_substr($text, $pos, 5);
            $pos += 5;
            return $result;
        }

        if (strpos(static::NUMERAL, mb_substr($text, $pos, 1)) === false) {
            return false;
        }

        $result = '';
        for(; $pos < $length; $pos++) {
            $ch = mb_substr($text, $pos, 1);

            if (strpos(static::NUMERAL_AND_POINT, $ch) === false) {
                return $result;
            }

            $result .= $ch;
        }

        return $result;
    }
}