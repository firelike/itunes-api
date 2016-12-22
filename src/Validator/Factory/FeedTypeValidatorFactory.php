<?php
namespace Firelike\ITunes\Validator\Factory;


use Firelike\ITunes\Validator\FeedTypeValidator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class FeedTypeValidatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        $validator = new FeedTypeValidator();
        return $validator;
    }

}