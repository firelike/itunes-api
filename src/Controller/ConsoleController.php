<?php
namespace Firelike\ITunes\Controller;

use Firelike\ITunes\Request\AbstractRequest;
use Firelike\ITunes\Request\Search\Search as SearchRequest;
use Firelike\ITunes\Request\Search\Lookup as LookupRequest;
use Zend\Mvc\Console\Controller\AbstractConsoleController;


class ConsoleController extends AbstractConsoleController
{
    /**
     * @var \Firelike\ITunes\Service\SearchService
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
            $request->setList('fiction');
        }

        $request->setSortOrder(AbstractRequest::SORT_ORDER_ASC);

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
     * @return \Firelike\ITunes\Service\SearchService
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param \Firelike\ITunes\Service\SearchService $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }


}

