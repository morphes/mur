<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Manadev\Core\Helper\Mb;
use Manadev\Seo\Data\Parser\TokenData;
use Manadev\Seo\Data\ParserData;

class ExtensionScanner
{
    /**
     * @var Mb
     */
    protected $mb;

    public function __construct(Mb $mb) {
        $this->mb = $mb;
    }

    /**
     * @param ParserData $parserState
     * @return TokenData[]|null
     */
    public function scan($parserState) {
        $extensionKeys = [];
        if (($pos = mb_strrpos($parserState->path, '.')) !== false) {
            $extensionKeys[] = mb_substr($parserState->path, $pos);
        }
        $extensionKeys[] = $this->mb->endsWith($parserState->path, '/') ? '/' : '';

        return $this->extensions($parserState, $extensionKeys);
    }

    /**
     * @param ParserData $parserState
     * @param string[] $extensionKeys
     * @return TokenData[]|null
     */
    protected function extensions($parserState, $extensionKeys) {
        $result = [];

        foreach ($extensionKeys as $extensionKey) {
            if ($extension = $this->extension($parserState, $extensionKey)) {
                $result[] = $extension;
            }
        }

        return count($result) ? $result : null;
    }

    /**
     * @param ParserData $parserState
     * @param string $extensionKey
     * @return TokenData
     */
    protected function extension($parserState, $extensionKey) {
        if (! ($routes = $this->routes($parserState, $extensionKey))) {
            return null;
        }

        return new TokenData([
            'text' => $extensionKey,
            'pos' => $parserState->path_length - mb_strlen($extensionKey),
            'length' => mb_strlen($extensionKey),
            'routes' => $routes,
        ]);
    }

    /**
     * @param ParserData $parserState
     * @param string $extensionKey
     * @return string[]|null
     */
    protected function routes($parserState, $extensionKey) {
        $result = [];

        foreach ($parserState->settings->extensions_by_route as $route => $extensions) {
            if (!isset($extensions[$extensionKey])) {
                if ($extensionKey == '.') {
                    continue;
                }

                if (!$this->mb->startsWith($extensionKey, '.')) {
                    continue;
                }

                if (!isset($extensions[mb_substr($extensionKey, 1)])) {
                    continue;
                }
            }

            $result[$route] = $extensions[$extensionKey];
        }

        return count($result) ? $result : null;
    }

}