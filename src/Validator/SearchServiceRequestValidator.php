<?php
namespace Firelike\ITunes\Validator;


use Firelike\ITunes\Request\AbstractRequest;
use Zend\Validator\AbstractValidator;
use Zend\Validator\Isbn\Isbn13;

class SearchServiceRequestValidator extends AbstractValidator
{
    /**
     * @var MediaValidator
     */
    protected $mediaValidator;

    /**
     * @var EntityValidator
     */
    protected $entityValidator;

    /**
     * @param mixed $request
     * @return bool
     */
    public function isValid($request)
    {
        if (!$request instanceof AbstractRequest) {
            return false;
        }


        if (method_exists($request, 'getMedia')) {
            if ($request->getMedia()) {
                $validator = $this->getMediaValidator();
                if (!$validator->isValid($request->getMedia())) {
                    $this->setMessage('Invalid media');
                    return false;
                }
            }
        }

        if (method_exists($request, 'getEntity')) {
            if ($request->getEntity()) {
                $validator = $this->getEntityValidator();
                if (!$validator->isValid($request->getEntity())) {
                    $this->setMessage('Invalid entity');
                    return false;
                }
            }
        }

        if (method_exists($request, 'getIsbn')) {
            if ($request->getIsbn()) {
                $validator = new Isbn13();
                if (!$validator->isValid($request->getIsbn())) {
                    $this->setMessage('Invalid ISBN-13');
                    return false;
                }
            }
        }


        return true;
    }

    /**
     * @return MediaValidator
     */
    public function getMediaValidator()
    {
        return $this->mediaValidator;
    }

    /**
     * @param MediaValidator $mediaValidator
     */
    public function setMediaValidator($mediaValidator)
    {
        $this->mediaValidator = $mediaValidator;
    }

    /**
     * @return EntityValidator
     */
    public function getEntityValidator()
    {
        return $this->entityValidator;
    }

    /**
     * @param EntityValidator $entityValidator
     */
    public function setEntityValidator($entityValidator)
    {
        $this->entityValidator = $entityValidator;
    }


}