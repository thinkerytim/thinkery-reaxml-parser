<?php

namespace ThinkReaXMLParser\Objects;

class Address
{
    protected $display_address = true; // default true
    protected $site;
    protected $subNumber;
    protected $lotNumber;
    protected $streetNumber;
    protected $street;
    protected $suburb;
    protected $municipality;
    protected $state;
    protected $region;
    protected $postcode;
    protected $country = 'AUS'; // default australia

    public function __construct(\SimpleXMLElement $address, $municipality = false)
    {
        // set display_address
        $this->setDisplayAddress($address->attributes()->display);
        // set site
        $this->setSite((string) $address->site);
        // set subNumber
        $this->setSubNumber((string) $address->subNumber);
        // set lotNumber
        $this->setLotNumber((string) $address->lotNumber);
        // set streetNumber
        $this->setStreetNumber((string) $address->streetNumber);
        // set street
        $this->setStreet((string) $address->street);
        // set suburb
        $this->setSuburb((string) $address->suburb);
        // set municipality
        $this->setMunicipality($municipality);
        // set state
        $this->setState((string) $address->state);
        // set region
        $this->setRegion((string) $address->region);
        // set postcode
        $this->setPostcode((string) $address->postcode);
        // set country
        $this->setCountry((string) $address->country);
    }

    /**
     * @return boolean
     */
    public function isDisplayAddress()
    {
        return $this->display_address;
    }

    /**
     * @param mixed $display_address
     * @return Address
     */
    public function setDisplayAddress($display_address)
    {
        $display = filter_var($display_address, FILTER_VALIDATE_BOOLEAN, ['default' => true]);
        $this->display_address = $display;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param mixed $site
     * @return Address
     */
    public function setSite($site)
    {
        $this->site = $site;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubNumber()
    {
        return $this->subNumber;
    }

    /**
     * @param mixed $subNumber
     * @return Address
     */
    public function setSubNumber($subNumber)
    {
        $this->subNumber = $subNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLotNumber()
    {
        return $this->lotNumber;
    }

    /**
     * @param mixed $lotNumber
     * @return Address
     */
    public function setLotNumber($lotNumber)
    {
        $this->lotNumber = $lotNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * @param mixed $streetNumber
     * @return Address
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSuburb()
    {
        return $this->suburb;
    }

    /**
     * @param mixed $suburb
     * @return Address
     */
    public function setSuburb($suburb)
    {
        $this->suburb = $suburb;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMunicipality()
    {
        return $this->municipality;
    }

    /**
     * @param mixed $municipality
     * @return Address
     */
    public function setMunicipality($municipality)
    {
        $this->municipality = $municipality;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     * @return Address
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     * @return Address
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     * @return Address
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return int
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param int $country
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }


}
