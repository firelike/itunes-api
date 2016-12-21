<?php
namespace Firelike\ITunes\Test\Service;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../../src/Service/SearchService.php';

require_once __DIR__ . '/../../src/Request/AbstractRequest.php';
require_once __DIR__ . '/../../src/Request/Search/Search.php';
require_once __DIR__ . '/../../src/Request/Search/Lookup.php';

require_once __DIR__ . '/../../src/Validator/SearchServiceRequestValidator.php';
require_once __DIR__ . '/../../src/Validator/EntityValidator.php';
require_once __DIR__ . '/../../src/Validator/MediaValidator.php';

use Firelike\ITunes\Request\Search\Search;
use Firelike\ITunes\Request\Search\Lookup;

use Firelike\ITunes\Service\SearchService;

use Firelike\ITunes\Validator\MediaValidator;
use Firelike\ITunes\Validator\EntityValidator;
use Firelike\ITunes\Validator\SearchServiceRequestValidator;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\ResultInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class BooksServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Firelike\ITunes\Service\SearchService
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();

        $mock = new MockHandler();
        $responses = [
            new Response(200, [], '{"resultCount":"5","results":"{}"}'),
            new Response(200, [], '{"resultCount":"5","results":"{}"}'),
        ];

        foreach ($responses as $response) {
            $mock->append($response);
        }

        $client = new Client([
            'handler' => $mock
        ]);

        //$client = new Client();

        $config = include __DIR__ . '/../../config/module.config.php';
        $description = new Description($config['itunes_service']['description']);

        $this->service = new SearchService($client, $description);

        $validator = new SearchServiceRequestValidator();
        $validator->setMediaValidator(new MediaValidator());
        $validator->setEntityValidator(new EntityValidator());

        $this->service->setRequestValidator($validator);

    }

    public function testSearch()
    {
        $request = new Search();
        $request->setTerm('michael connelly')
            ->setMedia('audiobook')
            ->setCountry('us')
            ->setLimit(5);

        $result = $this->service->search($request);
        //var_dump($result->toArray());

        $this->assertInstanceOf(ResultInterface::class, $result);
        $this->assertArrayHasKey('resultCount', $result->toArray());
        $this->assertArrayHasKey('results', $result->toArray());

    }

    public function testLookup()
    {
        $request = new Lookup();
        $request->setAmgAlbumId('15175,15176,15177,15178,15183,15184,15187,1519,15191,15195,15197,15198')
            ->setLimit(5);

        $result = $this->service->lookup($request);
        //var_dump($result->toArray());

        $this->assertInstanceOf(ResultInterface::class, $result);
        $this->assertArrayHasKey('resultCount', $result->toArray());
        $this->assertArrayHasKey('results', $result->toArray());
    }


}

