<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */
namespace Manadev\Seo;

use Manadev\Core\ConsoleHelper;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Application;

class PostInstallScript implements \Manadev\Core\Contracts\PostInstallScript
{
    /**
     * @var ConsoleHelper
     */
    protected $consoleHelper;

    public function __construct(ConsoleHelper $consoleHelper) {
        $this->consoleHelper = $consoleHelper;
    }

    public function execute(Application $application, OutputInterface $output, $mage) {
        $this->consoleHelper->run("$mage indexer:reindex mana_url_rewrite");
    }
}