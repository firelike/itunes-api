<?php
namespace Firelike\ITunes\Controller;

use Firelike\ITunes\Request\AvailableFeeds;
use Firelike\ITunes\Request\Feed;
use Firelike\ITunes\Request\Search as SearchRequest;
use Firelike\ITunes\Request\Lookup as LookupRequest;
use Laminas\Mvc\Console\Controller\AbstractConsoleController;


class ConsoleController extends AbstractConsoleController
{
    /**
     * @var \Firelike\ITunes\Service\ITunesService
     */
    protected $service;

    public function searchAction()
    {
        $this->markBegin();

        $request = new SearchRequest();

        $term = $this->getRequest()->getParam('term');
        if ($term) {
            $request->setTerm($term);
        } else {
            $request->setTerm('fiction');
        }

        $result = $this->getService()->search($request);

        $records = $result->toArray()['results'];

        var_dump($records);

        $this->markEnd();
    }

    public function lookupAction()
    {
        $this->markBegin();

        $request = new LookupRequest();

        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $request->setId($id);
        } else {
            $request->setId('123456');
        }

        $result = $this->getService()->lookup($request);

        $records = $result->toArray()['results'];

        var_dump($records);

        $this->markEnd();
    }

    public function feedAction()
    {
        $this->markBegin();

        $request = new Feed();

        $genre = $this->getRequest()->getParam('genre');
        if ($genre) {
            $request->setGenre($genre);
        } else {
            $request->setGenre('123456');
        }

        $result = $this->getService()->feed($request);

        $records = $result->toArray()['results'];

        var_dump($records);

        $this->markEnd();
    }

    public function availableFeedsAction()
    {
        $this->markBegin();

        $request = new AvailableFeeds();

        $country = $this->getRequest()->getParam('country');
        if ($country) {
            $request->setCountry($country);
        } else {
            $request->setCountry('us');
        }

        $result = $this->getService()->availableFeeds($request);

        $records = $result->toArray()['results'];

        var_dump($records);

        $this->markEnd();
    }

    public function genresAction()
    {
        $this->markBegin();

        $result = $this->getService()->genres();
        $records = $result->toArray()['results'];

        var_dump($records);

        $this->markEnd();
    }


    public function markBegin()
    {
        $delimiter = str_repeat('=', 10);
        $this->getConsole()->writeLine(implode('BEGIN', [
            $delimiter,
            $delimiter
        ]));
    }

    public function markEnd()
    {
        $request = $this->getRequest();
        $verbose = $request->getParam('verbose') || $request->getParam('v');

        if ($verbose) {
            $this->getConsole()->writeLine("Done");
        }

        $delimiter = str_repeat('=', 10);
        $this->getConsole()->writeLine(implode('END', [
            $delimiter,
            $delimiter
        ]));
    }

    /**
     * @return \Firelike\ITunes\Service\ITunesService
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param \Firelike\ITunes\Service\ITunesService $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }


}

