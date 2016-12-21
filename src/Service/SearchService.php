<?php
namespace Firelike\ITunes\Service;

use Firelike\ITunes\Request\Search\Search;
use Firelike\ITunes\Request\Search\Lookup;

use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\ResultInterface;

/**
 * Class BooksService
 * @package Firelike\ITunes\Service
 *
 * @method ResultInterface search_command(array $args)
 * @method ResultInterface lookup_command(array $args)
 */
class SearchService extends GuzzleClient
{
    /**
     * @var \Firelike\ITunes\Validator\SearchServiceRequestValidator
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
     * @return \Firelike\ITunes\Validator\SearchServiceRequestValidator
     */
    public function getRequestValidator()
    {
        return $this->requestValidator;
    }

    /**
     * @param \Firelike\ITunes\Validator\SearchServiceRequestValidator $requestValidator
     */
    public function setRequestValidator($requestValidator)
    {
        $this->requestValidator = $requestValidator;
    }

}