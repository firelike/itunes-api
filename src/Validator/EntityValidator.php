<?php
namespace Firelike\ITunes\Validator;


use Firelike\ITunes\Request\Search\Search;
use Zend\Validator\AbstractValidator;

class EntityValidator extends AbstractValidator
{
    /**
     * @param mixed $value
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
            $this->setMessage(sprintf('invalid entity for media type provided: %s . expecting % s', $value, implode(' or ', $haystack)));
            return false;
        }

    }

    protected function generateHaystack(Search $request)
    {

        $entities = [
            'movie' => [
                'movieArtist',
                'movie'
            ],
            'podcast' => [
                'podcastAuthor',
                'podcast'
            ],
            'music' => [
                'musicArtist',
                'musicTrack',
                'album',
                'musicVideo',
                'mix',
                'song'
            ],
            'musicVideo' => [
                'musicArtist',
                'musicVideo'
            ],
            'audiobook' => [
                'audiobookAuthor',
                'audiobook'
            ],
            'shortFilm' => [
                'shortFilmArtist',
                'shortFilm'
            ],
            'tvShow' => [
                'tvEpisode',
                'tvSeason'
            ],
            'software' => [
                'software',
                'iPadSoftware',
                'macSoftware'
            ],
            'ebook' => [
                'ebook'
            ],
            'all' => [
                'movie',
                'album',
                'allArtist',
                'podcast',
                'musicVideo',
                'mix',
                'audiobook',
                'tvSeason',
                'allTrack'
            ],
        ];

        if (isset($entities[$request->getMedia()])) {
            return $entities[$request->getMedia()];
        }

        return $entities['all'];

    }


}