<?php
namespace Firelike\ITunes\Service;

use Firelike\ITunes\Request\Search;
use Firelike\ITunes\Request\Lookup;
use Firelike\ITunes\Request\AvailableFeeds;
use Firelike\ITunes\Request\Feed;

use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\ResultInterface;

/**
 * Class ITunesService
 * @package Firelike\ITunes\Service
 *
 * @method ResultInterface search_command(array $args)
 * @method ResultInterface lookup_command(array $args)
 * @method ResultInterface feed_command(array $args)
 * @method ResultInterface available_feeds_command(array $args)
 * @method ResultInterface genres()
 *
 */
class ITunesService extends GuzzleClient
{
    /**
     * @var \Firelike\ITunes\Validator\ITunesServiceRequestValidator
     */
    protected $requestValidator;

    /**
     * @param Search $request
     * @return array|mixed
     */
    public function search(Search $request)
    {
        $validator = $this->getRequestValidator();
        if (!$validator->isValid($request)) {
            return $validator->getMessages();
        }

        return $this->search_command(array_filter($request->toArray()));
    }

    /**
     * @param Lookup $request
     * @return array|mixed
     */
    public function lookup(Lookup $request)
    {
        $validator = $this->getRequestValidator();
        if (!$validator->isValid($request)) {
            return $validator->getMessages();
        }

        return $this->lookup_command(array_filter($request->toArray()));
    }

    /**
     * @param Feed $request
     * @return array|mixed
     */
    public function feed(Feed $request)
    {
        $validator = $this->getRequestValidator();
        if (!$validator->isValid($request)) {
            return $validator->getMessages();
        }

        return $this->feed_command(array_filter($request->toArray()));
    }

    /**
     * @param AvailableFeeds $request
     * @return array|mixed
     */
    public function availableFeeds(AvailableFeeds $request)
    {
        $validator = $this->getRequestValidator();
        if (!$validator->isValid($request)) {
            return $validator->getMessages();
        }

        return $this->available_feeds_command(array_filter($request->toArray()));
    }


    /**
     * @return \Firelike\ITunes\Validator\ITunesServiceRequestValidator
     */
    public function getRequestValidator()
    {
        return $this->requestValidator;
    }

    /**
     * @param \Firelike\ITunes\Validator\ITunesServiceRequestValidator $requestValidator
     */
    public function setRequestValidator($requestValidator)
    {
        $this->requestValidator = $requestValidator;
    }

}