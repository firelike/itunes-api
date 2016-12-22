<?php
namespace Firelike\ITunes\Request;


class Feed extends AbstractRequest
{

    /**
     * @var string
     */
    protected $type;

    /**
     * @var integer
     */
    protected $size;

    /**
     * @var string
     */
    protected $genre;

    /**
     * @var string
     */
    protected $format;

    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'type' => $this->getType(),
            'size' => $this->getSize(),
            'genre' => $this->getGenre(),
            'format' => $this->getFormat(),
        ));
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Feed
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return Feed
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     * @return Feed
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return Feed
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }


}