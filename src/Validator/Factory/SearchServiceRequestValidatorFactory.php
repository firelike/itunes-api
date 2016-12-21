<?php
namespace Firelike\ITunes\Validator\Factory;


use Firelike\ITunes\Validator\SearchServiceRequestValidator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SearchServiceRequestValidatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        $validator = new SearchServiceRequestValidator();
        $validator->setMediaValidator($sm->get('Firelike\ITunes\Validator\MediaValidator'));
        $validator->setEntityValidator($sm->get('Firelike\ITunes\Validator\EntityValidator'));
        return $validator;
    }

}