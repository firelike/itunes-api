<?php
namespace Firelike\ITunes;

use Laminas\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Laminas\Console\Adapter\AdapterInterface as Console;

class Module implements ConsoleUsageProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


    public function getConsoleUsage(Console $console)
    {
        return array(
            // Describe available commands
            'itunes search [--term=] [--verbose|-v]' => 'call search service method',
            'itunes lookup [--id=] [--verbose|-v]' => 'call lookup service method',
            'itunes feed [--genre=] [--verbose|-v]' => 'call feed service method',
            'itunes available-feeds [--country=] [--verbose|-v]' => 'call availableFeeds service method',
            'itunes genres [--verbose|-v]' => 'call genres service method',

            // Describe expected parameters
            array(
                '--verbose|-v',
                '(optional) turn on verbose mode'
            ),
        );
    }
}