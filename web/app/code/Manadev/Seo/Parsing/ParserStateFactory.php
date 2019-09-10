<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Seo\Data\ParserData;

class ParserStateFactory
{
    /**
     * @param array $options
     * @return ParserData
     */
    public function initial(array $options) {
        $parserState = new ParserData($options);

        $parserState->path = ltrim(urldecode($parserState->request->getPathInfo()), '/');
        $parserState->path_pos = 0;
        $parserState->path_length = mb_strlen($parserState->path);
        $parserState->parent_pos = null;
        $parserState->parent_length = null;
        $parserState->parents = [];


        return $parserState;
    }

    /**
     * @param ParserData $parserState
     * @return ParserData
     */
    public function parent($parserState) {
        $parserState->path_pos = $parserState->parent_pos;
        $parserState->path_length = $parserState->parent_length;
        if (count($parserState->parents)) {
            list($parserState->parent_pos, $parserState->parent_length) = array_pop($parserState->parents);
        }
        else {
            $parserState->parent_pos = null;
            $parserState->parent_length = null;
        }
        return $parserState;
    }


    /**
     * @param ParserData $parserState
     * @return ParserData
     */
    public function prefix($parserState) {
        $parserState = clone $parserState;

        if ($parserState->parent_pos !== null) {
            array_push($parserState->parents, [$parserState->parent_pos, $parserState->parent_length]);
        }
        $parserState->parent_pos = $parserState->path_pos;
        $parserState->parent_length = $parserState->path_length;

        $parserState->path_pos = 0;

        $parserState->path_length = $parserState->page_url_key->delimiter_before
            ? $parserState->page_url_key->delimiter_before->pos
            : $parserState->page_url_key->pos;

        return $parserState;
    }

    /**
     * @param ParserData $parserState
     * @return ParserData
     */
    public function suffix($parserState) {
        $parserState = clone $parserState;

        if ($parserState->parent_pos !== null) {
            array_push($parserState->parents, [$parserState->parent_pos, $parserState->parent_length]);
        }
        $parserState->parent_pos = $parserState->path_pos;
        $parserState->parent_length = $parserState->path_length;

        $parserState->path_pos = $parserState->page_url_key->delimiter_after
            ? $parserState->page_url_key->delimiter_after->pos + $parserState->page_url_key->delimiter_after->length
            : $parserState->page_url_key->pos + $parserState->page_url_key->length;

        $parserState->path_length = $parserState->extension->pos - $parserState->path_pos;

        return $parserState;
    }

    /**
     * @param ParserData $parserState
     * @return ParserData
     */
    public function parameter($parserState) {
        $parserState = clone $parserState;

        if ($parserState->parent_pos !== null) {
            array_push($parserState->parents, [$parserState->parent_pos, $parserState->parent_length]);
        }
        $parserState->parent_pos = $parserState->path_pos;
        $parserState->parent_length = $parserState->path_length;

        $parserState->path_pos = $parserState->parameter->pos;
        $parserState->path_length = $parserState->parameter->length;

        return $parserState;
    }

    /**
     * @param ParserData $parserState
     * @return ParserData
     */
    public function otherParameters($parserState) {
        $parserState = clone $parserState;

        $parserState->path_pos = $parserState->parameter->delimiter_after
            ? $parserState->parameter->delimiter_after->pos +
                $parserState->parameter->delimiter_after->length
            : $parserState->parameter->pos + $parserState->parameter->length;

        $parserState->path_length = $parserState->parent_length + $parserState->parent_pos - $parserState->path_pos;

        return $parserState;
    }

    /**
     * @param ParserData $parserState
     * @return ParserData
     */
    public function value($parserState) {
        $parserState = clone $parserState;

        if ($parserState->parent_pos !== null) {
            array_push($parserState->parents, [$parserState->parent_pos, $parserState->parent_length]);
        }
        $parserState->parent_pos = $parserState->path_pos;
        $parserState->parent_length = $parserState->path_length;

        $parserState->path_pos = $parserState->parameter_url_key->delimiter_after
            ? $parserState->parameter_url_key->delimiter_after->pos +
                $parserState->parameter_url_key->delimiter_after->length
            : $parserState->parameter_url_key->pos + $parserState->parameter_url_key->length;

        $parserState->path_length = $parserState->parent_length + $parserState->parent_pos - $parserState->path_pos;

        return $parserState;
    }

    /**
     * @param ParserData $parserState
     * @return ParserData
     */
    public function nonPrefixedValue($parserState) {
        $parserState = clone $parserState;

        if ($parserState->parent_pos !== null) {
            array_push($parserState->parents, [$parserState->parent_pos, $parserState->parent_length]);
        }
        $parserState->parent_pos = $parserState->path_pos;
        $parserState->parent_length = $parserState->path_length;

        return $parserState;
    }

    /**
     * @param ParserData $parserState
     * @return ParserData
     */
    public function otherOptions($parserState) {
        $parserState = clone $parserState;

        $parserState->path_pos = $parserState->option_url_key->delimiter_after
            ? $parserState->option_url_key->delimiter_after->pos +
                $parserState->option_url_key->delimiter_after->length
            : $parserState->option_url_key->pos + $parserState->option_url_key->length;

        $parserState->path_length = $parserState->parent_length + $parserState->parent_pos - $parserState->path_pos;

        return $parserState;
    }


}