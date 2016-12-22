<?php
namespace Firelike\ITunes\Validator\Factory;


use Firelike\ITunes\Validator\EntityValidator;
use Firelike\ITunes\Validator\FeedTypeValidator;
use Firelike\ITunes\Validator\ITunesServiceRequestValidator;
use Firelike\ITunes\Validator\MediaValidator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ITunesServiceRequestValidatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        $validator = new ITunesServiceRequestValidator();
        $validator->setMediaValidator($sm->get(MediaValidator::class));
        $validator->setEntityValidator($sm->get(EntityValidator::class));
        $validator->setFeedTypeValidator($sm->get(FeedTypeValidator::class));
        return $validator;
    }

}