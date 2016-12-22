<?php
namespace Firelike\ITunes\Validator;


use Firelike\ITunes\Request\Search as SearchRequest;
use Zend\Validator\AbstractValidator;
use Zend\Validator\InArray;

class EntityValidator extends AbstractValidator
{
    /**
     * @param mixed $request
     * @return bool
     */
    public function isValid($request)
    {
        // do not evaluate if the request is not a Search request
        if (!$request instanceof SearchRequest) {
            return true;
        }

        $inArrayValidator = new InArray();

        $haystack = $this->generateHaystack($request);
        $inArrayValidator->setHaystack($haystack);

        if (!$inArrayValidator->isValid($request->getEntity())) {
            $this->setMessage(sprintf('invalid entity for media type provided: %s . expecting % s', $request->getEntity(), implode(' or ', $haystack)));
            return false;
        }

        return true;
    }

    protected function generateHaystack(SearchRequest $request)
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