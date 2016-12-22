<?php
namespace Firelike\ITunes\Request;


class Search extends AbstractRequest
{

    /**
     * @var string
     */
    protected $term;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $media;
    /**
     * @var string
     */
    protected $entity;
    /**
     * @var string
     */
    protected $attribute;
    /**
     * @var string
     */
    protected $callback;
    /**
     * @var integer
     */
    protected $limit;
    /**
     * @var string
     */
    protected $lang;
    /**
     * @var string
     */
    protected $version;
    /**
     * @var string
     */
    protected $explicit;


    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'term' => $this->getTerm(),
            'country' => $this->getCountry(),
            'media' => $this->getMedia(),
            'entity' => $this->getEntity(),
            'attribute' => $this->getAttribute(),
            'callback' => $this->getCallback(),
            'limit' => $this->getLimit(),
            'lang' => $this->getLang(),
            'version' => $this->getVersion(),
            'explicit' => $this->getExplicit(),
        ));

    }

    /**
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param string $term
     * @return $this
     */
    public function setTerm($term)
    {
        $this->term = $term;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param string $media
     * @return Search
     */
    public function setMedia($media)
    {
        $this->media = $media;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param string $entity
     * @return Search
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
        return $this;
    }

    /**
     * @return string
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param string $attribute
     * @return Search
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param string $callback
     * @return Search
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return Search
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     * @return Search
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return Search
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getExplicit()
    {
        return $this->explicit;
    }

    /**
     * @param string $explicit
     * @return Search
     */
    public function setExplicit($explicit)
    {
        $this->explicit = $explicit;
        return $this;
    }


}