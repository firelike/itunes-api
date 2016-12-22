<?php
namespace Firelike\ITunes\Test\Service;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../../src/Service/Factory/ITunesServiceFactory.php';
require_once __DIR__ . '/../../src/Service/ITunesService.php';

require_once __DIR__ . '/../../src/Request/AbstractRequest.php';
require_once __DIR__ . '/../../src/Request/Search.php';
require_once __DIR__ . '/../../src/Request/Lookup.php';
require_once __DIR__ . '/../../src/Request/Feed.php';
require_once __DIR__ . '/../../src/Request/AvailableFeeds.php';

require_once __DIR__ . '/../../src/Validator/ITunesServiceRequestValidator.php';
require_once __DIR__ . '/../../src/Validator/EntityValidator.php';
require_once __DIR__ . '/../../src/Validator/MediaValidator.php';

use Firelike\ITunes\Request\Search;
use Firelike\ITunes\Request\Lookup;
use Firelike\ITunes\Request\Feed;
use Firelike\ITunes\Request\AvailableFeeds;

use Firelike\ITunes\Service\Factory\ITunesServiceFactory;
use Firelike\ITunes\Service\ITunesService;

use Firelike\ITunes\Validator\FeedTypeValidator;
use Firelike\ITunes\Validator\MediaValidator;
use Firelike\ITunes\Validator\EntityValidator;
use Firelike\ITunes\Validator\ITunesServiceRequestValidator;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\ResultInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class ITunesServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Firelike\ITunes\Service\ITunesService
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();


        $client= $this->createClientWithMockHandler();
        //$client = $this->createClientWithHandler();


        $config = include __DIR__ . '/../../config/module.config.php';
        $description = new Description($config['itunes_service']['description']);

        $this->service = new ITunesService($client, $description);

        $validator = new ITunesServiceRequestValidator();
        $validator->setMediaValidator(new MediaValidator());
        $validator->setEntityValidator(new EntityValidator());
        $validator->setFeedTypeValidator(new FeedTypeValidator());

        $this->service->setRequestValidator($validator);

    }

    protected function createClientWithHandler()
    {

        $config = [
            'itunes_service' => [
                'log' => [
                    'enable' => false,
                    'message_formats' => [
                        '{method} {uri} HTTP/{version} {req_body}',
                        'RESPONSE: {code} - {res_body}',
                    ],
                    'logger' => [
                        'stream' => 'php://output',
                    ]
                ]
            ]
        ];
        $factory = new ITunesServiceFactory();
        $handlerStack = $factory->createHandlerStack($config['itunes_service']['log']);


        $client = new Client([
            'handler' => $handlerStack
        ]);

        return $client;
    }


    protected function createClientWithMockHandler()
    {

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
        return $client;
    }



    public function testSearch()
    {
        $request = new Search();
        $request->setTerm('michael connelly')
            ->setMedia('audiobook')
            ->setCountry('us')
            ->setLimit(5);

        $result = $this->service->search($request);

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

        $this->assertInstanceOf(ResultInterface::class, $result);
        $this->assertArrayHasKey('resultCount', $result->toArray());
        $this->assertArrayHasKey('results', $result->toArray());
    }

    public function testFeed()
    {
        $request = new Feed();
        $request->setType('topaudiobooks')
            ->setSize(20)
            ->setGenre(50000024)
            ->setFormat('json');

        $result = $this->service->feed($request);

        $this->assertInstanceOf(ResultInterface::class, $result);
    }

    public function testAvailableFeeds()
    {
        $request = new AvailableFeeds();
        $request->setCountry('us');

        $result = $this->service->availableFeeds($request);
        $this->assertInstanceOf(ResultInterface::class, $result);

    }

    public function testGenres()
    {
        $result = $this->service->genres();
        $this->assertInstanceOf(ResultInterface::class, $result);
    }

    public function testEntityValidatorWorksWithInvalidValues()
    {
        $validator = new EntityValidator();
        $request = new Search();
        $request->setMedia('music')->setEntity('zz_song');
        $result = $validator->isValid($request);
        $this->assertEquals(false, $result);
    }

    public function testFeedTypeValidatorWorksWithInvalidValues()
    {
        $validator = new FeedTypeValidator();
        $result = $validator->isValid('zz_topaudiobooks');
        $this->assertEquals(false, $result);
    }

    public function testMediaValidatorWorksWithInvalidValues()
    {
        $validator = new MediaValidator();
        $result = $validator->isValid('zz_audiobooks');
        $this->assertEquals(false, $result);
    }


}

