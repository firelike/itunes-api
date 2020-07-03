<?php
namespace Firelike\ITunes\Validator;


use Laminas\Validator\AbstractValidator;
use Laminas\Validator\InArray;

class MediaValidator extends AbstractValidator
{
    /**
     * @param string $value
     * @return bool
     */
    public function isValid($value)
    {
        $inArrayValidator = new InArray();

        $haystack = [
            'movie',
            'podcast',
            'music',
            'musicVideo',
            'audiobook',
            'shortFilm',
            'tvShow',
            'software',
            'ebook',
            'all'
        ];
        $inArrayValidator->setHaystack($haystack);

        if (!$inArrayValidator->isValid($value)) {
            $this->setMessage(sprintf('invalid media type provided: %s . expecting % s', $value, implode(' or ', $haystack)));
            return false;
        }

        return true;
    }
}