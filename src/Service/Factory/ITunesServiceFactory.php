<?php
namespace Firelike\ITunes\Service\Factory;


use Firelike\ITunes\Service\ITunesService;
use Firelike\ITunes\Validator\ITunesServiceRequestValidator;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Http\Message\ResponseInterface;
use Zend\Log\Logger;
use Zend\Log\PsrLoggerAdapter;
use Zend\Log\Writer\Stream as StreamWriter;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use GuzzleHttp\Client;


class ITunesServiceFactory implements FactoryInterface
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

        $handlerStack = $this->createHandlerStack($config);
        $client = new Client([
            'handler' => $handlerStack
        ]);


        $description = new Description($config['itunes_service']['description']);

        $service = new ITunesService($client, $description);

        $service->setRequestValidator($sm->get(ITunesServiceRequestValidator::class));

        return $service;

    }


    public function createHandlerStack(array $config)
    {
        $handlerStack = HandlerStack::create();

        // push response fix middleware
        $handlerStack->push($this->createFixResponseBodyMiddleware());

        // append log middleware if enabled
        if (isset($config['itunes_service']['log'])) {

            $logConfig = $config['itunes_service']['log'];

            if (isset($logConfig['enable'])) {

                if ($logConfig['enable'] == true) {

                    $logger = new Logger();

                    $stream = 'php://output';
                    if (isset($logConfig['logger'])) {
                        if (isset($logConfig['logger']['stream'])) {
                            $stream = $logConfig['logger']['stream'];
                        }
                    }
                    $writer = new StreamWriter($stream);
                    $logger->addWriter($writer);

                    $psrLogger = new PsrLoggerAdapter($logger);

                    $messageFormats = [];
                    if (isset($logConfig['message_formats'])) {
                        $messageFormats = $logConfig['message_formats'];
                    }
                    foreach ($messageFormats as $messageFormat) {
                        $handlerStack->unshift(
                            Middleware::log($psrLogger, new MessageFormatter($messageFormat))
                        );
                    }

                }
            }
        }

        return $handlerStack;
    }

    private function createFixResponseBodyMiddleware()
    {
        return Middleware::mapResponse(function (ResponseInterface $response) {

            $body = (string)$response->getBody();
            if (preg_match('/^availableFeeds=/', $body) == 1) {
                $body = preg_replace('/^availableFeeds=/', '', $body);
            }

            $stream = \GuzzleHttp\Psr7\stream_for($body);

            return $response->withBody($stream);
        });
    }

}