<?php
namespace Firelike\ITunes\Service\Factory;


use Firelike\ITunes\Service\SearchService;
use Firelike\ITunes\Validator\SearchServiceRequestValidator;
use GuzzleHttp\Command\Guzzle\Description;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use GuzzleHttp\Client;


class SearchServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {

        $config = $sm->get('Config');

        if (!isset($config['itunes_service'])) {
            throw  new \Exception('Required configuration node - itunes_service is missing');
        }

        if (!isset($config['itunes_service']['description'])) {
            throw  new \Exception('Required itunes_service configuration parameters are missing is missing');
        }

        $client = new Client();

        $description = new Description($config['itunes_service']['description']);

        $service = new SearchService($client, $description);

        $service->setRequestValidator($sm->get(SearchServiceRequestValidator::class));

        return $service;

    }

}