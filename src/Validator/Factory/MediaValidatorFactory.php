<?php
namespace Firelike\ITunes\Validator\Factory;


use Firelike\ITunes\Validator\MediaValidator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class MediaValidatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        $validator = new MediaValidator();
        return $validator;
    }

}