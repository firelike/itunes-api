<?php
namespace Firelike\ITunes\Request;


class AvailableFeeds extends AbstractRequest
{

    /**
     * @var string
     */
    protected $country;

    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'cc' => $this->getCountry(),
        ));
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


}