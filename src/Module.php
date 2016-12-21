<?php
namespace Firelike\ITunes;

use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;

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

            // Describe expected parameters
            array(
                '--verbose|-v',
                '(optional) turn on verbose mode'
            ),
        );
    }
}