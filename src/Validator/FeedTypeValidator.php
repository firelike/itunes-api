<?php
namespace Firelike\ITunes\Validator;


use Zend\Validator\AbstractValidator;
use Zend\Validator\InArray;

class FeedTypeValidator extends AbstractValidator
{
    /**
     * @param string $value
     * @return bool
     */
    public function isValid($value)
    {

        $inArrayValidator = new InArray();

        $haystack = $this->generateHaystack();
        $inArrayValidator->setHaystack($haystack);

        if (!$inArrayValidator->isValid($value)) {
            $this->setMessage(sprintf('invalid feed type provided: %s . expecting % s', $value, implode(' or ', $haystack)));
            return false;
        }

        return true;
    }

    protected function generateHaystack()
    {

        $feedTypeGroups = [
            'audiobooks' => [
                'topaudiobooks',
            ],
            'books' => [
                'topfreeebooks',
                'toppaidebooks',
                'toptextbooks'
            ],
            'iosapps' => [
                'newapplications',
                'newfreeapplications',
                'newpaidapplications',
                'topfreeapplications',
                'topfreeipadapplications',
                'topgrossingapplications',
                'topgrossingipadapplications',
                'toppaidapplications',
                'toppaidipadapplications'
            ],
            'itunesu' => [
                'topitunesucollections',
                'topitunesucourses'
            ],
            'macapps' => [
                'topfreemacapps',
                'topgrossingmacapps',
                'topmacapps',
                'toppaidmacapps'
            ],
            'movies' => [
                'topmovies',
                'topvideorentals'
            ],
            'music' => [
                'topalbums',
                'topimixes',
                'topsongs'
            ],
            'musicVideos' => [
                'topmusicvideos',
            ],
            'podcasts' => [
                'toppodcasts'
            ],
            'tvShows' => [
                'toptvepisodes',
                'toptvseasons'
            ]
        ];

        $feedTypes = [];
        array_walk_recursive($feedTypeGroups, function ($feedType) use (&$feedTypes) {
            $feedTypes[] = $feedType;
        });
        return $feedTypes;
    }


}