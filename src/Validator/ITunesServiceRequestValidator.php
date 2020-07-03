<?php
namespace Firelike\ITunes\Validator;


use Firelike\ITunes\Request\AbstractRequest;
use Laminas\Validator\AbstractValidator;

class ITunesServiceRequestValidator extends AbstractValidator
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
     * @var FeedTypeValidator
     */
    protected $feedTypeValidator;

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
                if (!$validator->isValid($request)) {
                    $this->setMessage('Invalid entity');
                    return false;
                }
            }
        }

        if (method_exists($request, 'getType')) {
            if ($request->getType()) {
                $validator = $this->getFeedTypeValidator();
                if (!$validator->isValid($request->getType())) {
                    $this->setMessage('Invalid Feed Type');
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

    /**
     * @return FeedTypeValidator
     */
    public function getFeedTypeValidator()
    {
        return $this->feedTypeValidator;
    }

    /**
     * @param FeedTypeValidator $feedTypeValidator
     */
    public function setFeedTypeValidator($feedTypeValidator)
    {
        $this->feedTypeValidator = $feedTypeValidator;
    }


}