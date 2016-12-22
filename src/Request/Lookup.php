<?php
namespace Firelike\ITunes\Request;


class Lookup extends AbstractRequest
{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $upc;

    /**
     * @var string
     */
    protected $isbn;

    /**
     * @var string
     */
    protected $amgArtistId;

    /**
     * @var string
     */
    protected $amgAlbumId;

    /**
     * @var string
     */
    protected $amgVideoId;

    /**
     * @var string
     */
    protected $entity;

    /**
     * @var integer
     */
    protected $limit;

    /**
     * @var integer
     */
    protected $sort;

    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'id' => $this->getId(),
            'upc' => $this->getUpc(),
            'isbn' => $this->getIsbn(),
            'amgArtistId' => $this->getAmgArtistId(),
            'amgAlbumId' => $this->getAmgAlbumId(),
            'amgVideoId' => $this->getAmgVideoId(),
            'entity' => $this->getEntity(),
            'limit' => $this->getLimit(),
            'sort' => $this->getSort(),
        ));
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Lookup
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpc()
    {
        return $this->upc;
    }

    /**
     * @param string $upc
     * @return Lookup
     */
    public function setUpc($upc)
    {
        $this->upc = $upc;
        return $this;
    }

    /**
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     * @return Lookup
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmgArtistId()
    {
        return $this->amgArtistId;
    }

    /**
     * @param string $amgArtistId
     * @return Lookup
     */
    public function setAmgArtistId($amgArtistId)
    {
        $this->amgArtistId = $amgArtistId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmgAlbumId()
    {
        return $this->amgAlbumId;
    }

    /**
     * @param string $amgAlbumId
     * @return Lookup
     */
    public function setAmgAlbumId($amgAlbumId)
    {
        $this->amgAlbumId = $amgAlbumId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmgVideoId()
    {
        return $this->amgVideoId;
    }

    /**
     * @param string $amgVideoId
     * @return Lookup
     */
    public function setAmgVideoId($amgVideoId)
    {
        $this->amgVideoId = $amgVideoId;
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
     * @return Lookup
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
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
     * @return Lookup
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     * @return Lookup
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
        return $this;
    }


}