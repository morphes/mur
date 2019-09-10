<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Parsing;

use Magento\Store\Model\StoreManagerInterface;
use Manadev\Core\Data;
use Manadev\Core\LogicLogger;
use Manadev\Core\Profiler;
use Manadev\Core\QueryLogger;
use Manadev\Seo\Configuration;
use Manadev\Seo\Data\Parser\ResultData;
use Manadev\Seo\Data\ParserData;
use Magento\Framework\App\Request\Http as Request;
use Manadev\Seo\Enums\UrlKeyStatus;
use Manadev\Seo\Enums\UrlKeySubType;
use Manadev\Seo\Enums\UrlKeyType;
use Manadev\Seo\Registries\UrlKeySubTypes;

class Parser
{
    /**
     * @var ExtensionScanner
     */
    protected $extensionScanner;
    /**
     * @var DelimiterScanner
     */
    protected $delimiterScanner;
    /**
     * @var KeyScanner
     */
    private $keyScanner;
    /**
     * @var SegmentScanner
     */
    protected $segmentScanner;
    /**
     * @var ParserStateFactory
     */
    protected $parserStateFactory;

    /**
     * @var UrlKeySubTypes
     */
    protected $urlKeySubTypes;
    /**
     * @var ParsingHelper
     */
    protected $helper;
    /**
     * @var ActiveUrlSettings[]|RedirectedUrlSettings[]
     */
    protected $urlSettings;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var GeneralUrlSettings
     */
    protected $generalUrlSettings;
    /**
     * @var Configuration
     */
    protected $configuration;
    /**
     * @var QueryLogger
     */
    protected $queryLogger;
    /**
     * @var Profiler
     */
    protected $profiler;
    /**
     * @var LogicLogger
     */
    protected $logger;

    public function __construct(ExtensionScanner $extensionScanner, DelimiterScanner $delimiterScanner,
        KeyScanner $keyScanner, SegmentScanner $segmentScanner, ParserStateFactory $parserStateFactory,
        UrlKeySubTypes $urlKeySubTypes, ParsingHelper $helper, ActiveUrlSettings $activeUrlSettings,
        RedirectedUrlSettings $redirectedUrlSettings, StoreManagerInterface $storeManager,
        GeneralUrlSettings $generalUrlSettings, Configuration $configuration, QueryLogger $queryLogger,
        Profiler $profiler)
    {
        $this->extensionScanner = $extensionScanner;
        $this->delimiterScanner = $delimiterScanner;
        $this->keyScanner = $keyScanner;
        $this->segmentScanner = $segmentScanner;
        $this->parserStateFactory = $parserStateFactory;
        $this->urlKeySubTypes = $urlKeySubTypes;
        $this->helper = $helper;
        $this->urlSettings = [
            UrlKeyStatus::ACTIVE => $activeUrlSettings,
            UrlKeyStatus::REDIRECTED => $redirectedUrlSettings,
        ];
        $this->storeManager = $storeManager;
        $this->generalUrlSettings = $generalUrlSettings;
        $this->configuration = $configuration;
        $this->queryLogger = $queryLogger;
        $this->profiler = $profiler;

        $this->logger = new LogicLogger('seo-logic', $this->configuration->isParserLogicLoggingEnabled());
    }

    /**
     * @param Request $request
     * @return ResultData
     */
    public function parse($request) {
        $this->profiler->start('seo-url-parser');
        if ($this->configuration->isParserLoggingEnabled()) {
            $this->queryLogger->begin('seo-url-parser');
        }

        try {
            return $this->doParse($request);
        }
        finally {
            if ($this->configuration->isParserLoggingEnabled()) {
                $this->queryLogger->end('seo-url-parser');
            }
            $this->profiler->stop('seo-url-parser');
        }
    }

    /**
     * @param Request $request
     * @return ResultData
     */
    protected function doParse($request) {
        $parserState = $this->parserStateFactory->initial([
            'request' => $request,
            'settings' => $this->generalUrlSettings->getSettings(),
            'store_id' => $this->storeManager->getStore()->getId(),
        ]);

        if (!($parserState->extensions = $this->extensionScanner->scan($parserState))) {
            return null;
        }

        $parserState->delimiters = $this->delimiterScanner->scan($parserState);
        $parserState->url_keys = $this->keyScanner->scan($parserState);

        foreach ($this->urlSettings as $status => $settingsProvider) {
            $parserState->settings = Data::merge($parserState->settings, $settingsProvider->getSettings());
            $this->logger->enter('Status: %s', $status);
            $this->logger->log("State: %s", json_encode($parserState, JSON_PRETTY_PRINT));
            $this->helper->clearFailedAttempts();

            if (!($result = $this->parsePath($parserState))) {
                $this->logger->leave('path not parsed');
                continue;
            }

            if (!($result = $this->parseQuery($result))) {
                $this->logger->leave('query not parsed');
                continue;
            }

            $this->logger->leave('OK');
            return $this->createResult($result);
        }

        return null;
    }


    /**
     * @param ParserData $parserState
     * @return ParserData
     */
    protected function parsePath($parserState) {
        if ($result = $this->parsePagePath($parserState)) {
            return $result;
        }

        if ($result = $this->parseHomePath($parserState)) {
            return $result;
        }

        return null;
    }

    /**
     * <page_path> ::= [<prefix> <prefix_delimiter>] <page_url_key> [<suffix_delimiter> <suffix>] [<extension>]
     *
     * @param ParserData $parserState
     * @return ParserData
     */
    protected function parsePagePath($parserState) {
        foreach ($this->segmentScanner->scan($parserState, $parserState->settings->prefix_delimiters,
            $parserState->settings->suffix_delimiters) as $token)
        {
            if (! ($token->record = $this->helper->findUrlKey($parserState, $token->text, UrlKeyType::PAGE))) {
                continue;
            }

            $this->logger->enter('page: %s (%d, %d)', $token->text, $token->pos, $token->length);
            $result = $parserState;
            $result->page_url_key = $token;
            $result->route = $token->record->route;
            $this->logger->log('route: %s', $token->record->route);

            if ($result = $this->parseExtension($result)) {
                $this->logger->leave('OK');
                return $result;
            }
            $this->logger->leave();
        }

        return null;
    }

    /**
     * <home_path> ::= [<prefix> <prefix_delimiter>] [<suffix>] [<extension>]
     *
     * @param ParserData $parserState
     * @return ParserData
     */
    protected function parseHomePath($parserState) {
        if (!$parserState->path_length) {
            return null;
        }

        if (!$parserState->settings->home_page_has_parameters) {
            return null;
        }
        $parserState->route = 'cms/index/index';

        foreach ($this->segmentScanner->scan($parserState, $parserState->settings->prefix_delimiters, []) as $token)
        {
            $this->logger->enter('home page: suffix starting at %d', $token->pos);
            $parserState->page_url_key = $token;
            $parserState->page_url_key->length = 0;

            if ($result = $this->parseExtension($parserState)) {
                $this->logger->leave('OK');
                return $result;
            }
            $this->logger->leave();
        }

        return null;
    }

    /**
     * @param ParserData $parserState
     * @return ParserData
     */
    protected function parseExtension($parserState) {
        $route = $parserState->route;

        foreach ($parserState->extensions as $extension) {
            if (!isset($extension->routes[$route])) {
                continue;
            }

            if ($parserState->settings->status == UrlKeyStatus::ACTIVE &&
                !$extension->routes[$route])
            {
                continue;
            }

            if ($parserState->page_url_key->pos + $parserState->page_url_key->length > $extension->pos) {
                continue;
            }

            $parsingAttempt = "extension.{$parserState->page_url_key->pos}.{$parserState->page_url_key->length}.{$extension->pos}";

            if ($this->helper->isAttemptFailed($parsingAttempt)) {
                continue;
            }

            $this->logger->enter('extension: %s', $extension->text);
            $result = $parserState;
            $result->extension = $extension;
            $result->prefix_parameters = [];
            $result->suffix_parameters = [];

            if (!($childResult = $this->parsePathParameters('prefix', $this->parserStateFactory->prefix($result)))) {
                $this->helper->markAttemptAsFailed($parsingAttempt);
                $this->logger->leave('prefix not parsed');
                continue;
            }
            $result = $this->parserStateFactory->parent($childResult);

            if (!($childResult = $this->parsePathParameters('suffix', $this->parserStateFactory->suffix($result)))) {
                $this->helper->markAttemptAsFailed($parsingAttempt);
                $this->logger->leave('suffix not parsed');
                continue;
            }
            $result = $this->parserStateFactory->parent($childResult);

            $this->logger->leave('OK');
            return $result;
        }

        return null;
    }

    /**
     * <prefix> ::= <prefix_parameter> { <prefix_parameter_delimiter> <prefix_parameter> }
     * <suffix> ::= <suffix_parameter> { <suffix_parameter_delimiter> <suffix_parameter> }
     *
     * @param string $part
     * @param ParserData $parserState
     * @return ParserData
     */
    protected function parsePathParameters($part, $parserState) {
        $this->logger->enter('%s parameters : %s(%d, %d)', $part,
            mb_substr($parserState->path, $parserState->path_pos, $parserState->path_length),
            $parserState->path_pos, $parserState->path_length);

        if (!$parserState->path_length) {
            $this->logger->leave('empty');
            return $parserState;
        }

        foreach ($this->segmentScanner->scan($parserState, null,
            $parserState->settings->{$part . '_parameter_delimiters'}) as $token)
        {
            $parsingAttempt = "parameters.{$parserState->path_pos}.{$parserState->path_length}." .
                "{$token->pos}.{$token->length}";
            if ($this->helper->isAttemptFailed($parsingAttempt)) {
                continue;
            }

            $result = clone $parserState;
            $result->parameter = $token;

            if (!($childResult = $this->parsePathParameter($part, $this->parserStateFactory->parameter($result)))) {
                $this->helper->markAttemptAsFailed($parsingAttempt);
                continue;
            }

            $childResult->{$part . '_parameters'}[$childResult->parameter_name] = $childResult->parameter_value;
            if (!($childResult = $this->parsePathParameters($part, $this->parserStateFactory->otherParameters($childResult)))) {
                $this->helper->markAttemptAsFailed($parsingAttempt);
                continue;
            }
            $result = $this->parserStateFactory->parent($childResult);

            $this->logger->leave('OK');
            return $result;
        }

        $this->logger->leave();
        return null;
    }

    /**
     * @param string $part
     * @param ParserData $parserState
     * @return ParserData
     */
    protected function parsePathParameter($part, $parserState) {
        $this->logger->enter('parameter: %s(%d, %d)',
            mb_substr($parserState->path, $parserState->path_pos, $parserState->path_length),
            $parserState->path_pos, $parserState->path_length);

        foreach ($this->segmentScanner->scan($parserState, null,
            $parserState->settings->{$part . '_value_delimiters'}) as $token)
        {
            $parsingAttempt = "parameter.{$parserState->path_pos}.{$parserState->path_length}." .
                "{$token->pos}.{$token->length}";
            if ($this->helper->isAttemptFailed($parsingAttempt)) {
                continue;
            }

            if (! ($token->record = $this->helper->findUrlKey($parserState, $token->text, UrlKeyType::PARAMETER))) {
                $this->helper->markAttemptAsFailed($parsingAttempt);
                continue;
            }

            $result = $parserState;
            $result->parameter_url_key = $token;
            $result->parameter_name = $token->record->param_name;
            $result->parameter_value = null;

            if (!($childResult = $this->parsePathValue($part, $this->parserStateFactory->value($result)))) {
                $this->helper->markAttemptAsFailed($parsingAttempt);
                continue;
            }
            $result = $this->parserStateFactory->parent($childResult);

            $this->logger->leave('%s = %s', $result->parameter_name, $result->parameter_value);
            return $result;
        }

        $result = $parserState;
        $result->parameter_url_key = null;
        $result->parameter_name = '';
        $result->parameter_value = null;

        if ($childResult = $this->parsePathValue($part, $this->parserStateFactory->nonPrefixedValue($result))) {
            $result = $this->parserStateFactory->parent($childResult);
            $result->{$part . '_parameters'}[$result->parameter_name] = $result->parameter_value;
            $this->logger->leave('untitled: %s = %s', $result->parameter_name, $result->parameter_value);
            return $result;
        }

        $this->logger->leave();
        return null;
    }

    /**
     * @param string $part
     * @param ParserData $parserState
     * @return ParserData
     */
    protected function parsePathValue($part, $parserState) {
        if ($result = $this->parseNamedPathValue($part, $parserState)) {
            return $result;
        }

        foreach ($this->urlKeySubTypes->getList() as $urlKeySubType) {
            if ($urlKeySubType->getType() != UrlKeyType::PARAMETER) {
                continue;
            }

            if (!$urlKeySubType->allowsPositionalParameterValues()) {
                continue;
            }

            if (!($parser = $urlKeySubType->getParameterParser())) {
                return null;
            }

            if ($result = $parser->parse($part, $parserState)) {
                return $result;
            }
        }

        return null;
    }

    /**
     * @param string $part
     * @param ParserData $parserState
     * @return ParserData
     */
    protected function parseNamedPathValue($part, $parserState) {
        if (!$parserState->parameter_url_key) {
            return null;
        }
        $subType = $parserState->parameter_url_key->record->sub_type;

        if (! ($urlKeySubType = $this->urlKeySubTypes->get($subType))) {
            return null;
        }

        if (! ($parser = $urlKeySubType->getParameterParser())) {
            return null;
        }

        return $parser->parse($part, $parserState);
    }

    /**
     * @param ParserData $parserState
     * @return ParserData
     */
    protected function parseQuery($parserState) {
        $parserState->query_parameters = $parserState->request->getQuery()->toArray();

        return $parserState;
    }

    /**
     * @param ParserData $parserState
     * @return ResultData
     */
    protected function createResult($parserState) {
        $path = $parserState->route;
        if ($parserState->page_url_key->record) {
            $params = $this->urlKeySubTypes->get($parserState->page_url_key->record->sub_type)
                ->getRouteParameters($parserState->page_url_key->record);
        }
        else {
            $params = [];
        }

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $path .= '/' . $key . '/' . $value;
            }
        }

        return new ResultData([
            'alias' => $parserState->path,
            'path' => $path,
            'route' => $parserState->route,
            'params' => $params,
            'query' => array_merge(
                $parserState->prefix_parameters,
                $parserState->suffix_parameters,
                $parserState->query_parameters
            ),
            'status' => $parserState->settings->status,
            'page_url_key' => $parserState->page_url_key->text,
        ]);
    }

    protected function log($message) {
        if (!$this->configuration->isParserLogicLoggingEnabled()) {
            return;
        }


    }
}