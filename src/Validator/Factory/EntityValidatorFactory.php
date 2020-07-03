<?php
namespace Firelike\ITunes\Validator\Factory;


use Firelike\ITunes\Validator\EntityValidator;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class EntityValidatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        $validator = new EntityValidator();
        return $validator;
    }

}