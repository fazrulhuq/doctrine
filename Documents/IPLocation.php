<?php

namespace Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** 
 * @ODM\Document(collection="ip_location")
 */
class IPLocation {

    /**
     * @ODM\Id
     */
    private $id;
    
    /**
     * @ODM\Float 
     * @ODM\Index(unique=true, order="asc") 
     * @ODM\Field(name="ip_from")
     */
    private $ipFrom;    
    
    /**
     * @ODM\Float 
     * @ODM\Field(name="ip_to")
     */
    private $ipTo;    
    
    /** 
     * @ODM\String
     * @ODM\Field(name="country_code")
     */
    private $countryCode;

    /**
     * @ODM\String
     * @ODM\Field(name="country_name")
     */
    private $countryName;

    /**
     * @ODM\String`
     */
    private $region;
    
    /**
     * @ODM\String
     */
    private $city;

    /**
     * @ODM\String
     */
    private $zipcode;
    
    /**
     * @ODM\Float
     */
    private $latitude;
    
    /**
     * @ODM\Float
     */
    private $longitude;
    
    
    public function getId()
    {
        return $this->id;
    }

    public function getIpFrom()
    {
        return $this->ipFrom;
    }

    public function getIpTo()
    {
        return $this->ipTo;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getCountryName()
    {
        return $this->countryName;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIpFrom($ipFrom)
    {
        $this->ipFrom = $ipFrom;
    }

    public function setIpTo($ipTo)
    {
        $this->ipTo = $ipTo;
    }

    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
    }

    public function setRegion($region)
    {
        $this->region = $region;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }
    
    public function toArray()
    {
        return array(
            'countryCode' => $this->countryCode,
            'countryName' => $this->countryName,
            'region' => $this->region,
            'city' => $this->city,
            'zipcode' => $this->zipcode,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        );
    }

    public function toJSON()
    {
        return json_encode($this->toArray());
    }

}
