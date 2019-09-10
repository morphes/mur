<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSeo\Parsing;

use Manadev\Seo\Data\ParserData;
use Manadev\Seo\Enums\UrlKeySubType;
use Manadev\Seo\Enums\UrlKeyType;

class OptionFilterParameterParser extends FilterParameterParser
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

        if (empty($parserState->parameter_value)) {
            $parserState->parameter_value = '';
        }

        foreach ($this->segmentScanner->scan($parserState, null,
            $parserState->settings->{$part . '_option_delimiters'}) as $token)
        {
            $parsingAttempt = "option.{$parserState->path_pos}.{$parserState->path_length}." .
                "{$token->pos}.{$token->length}";
            if ($this->helper->isAttemptFailed($parsingAttempt)) {
                continue;
            }

            if (! ($token->record = $this->helper->findUrlKey($parserState, $token->text, UrlKeyType::OPTION,
                $parserState->parameter_name)))
            {
                $this->helper->markAttemptAsFailed($parsingAttempt);
                continue;
            }

            if ($token->record->sub_type != UrlKeySubType::FILTER_OPTION) {
                $this->helper->markAttemptAsFailed($parsingAttempt);
                continue;
            }

            if (!$parserState->parameter_name && $token->record->requires_param_name) {
                $this->helper->markAttemptAsFailed($parsingAttempt);
                continue;
            }

            $result = clone $parserState;
            $result->option_url_key = $token;
            $result->parameter_name = $token->record->param_name;
            if ($result->parameter_value) {
                $result->parameter_value .= $this->urlSettings->getMultipleValueSeparator();
            }
            $result->parameter_value .= $token->record->option_id;

            $result = $this->parserStateFactory->otherOptions($result);
            if (!$result->path_length) {
                return $result;
            }

            if (!($result = $this->parse($part, $result))) {
                $this->helper->markAttemptAsFailed($parsingAttempt);
                continue;
            }

            return $result;
        }

        return null;
    }
}