<?php

namespace Alexandreo\DataBindr\Requests;

use Illuminate\Support\Collection;
use SameerShelavale\PhpCountriesArray\CountriesArray;

/**
 * Class HotelBindrRequest
 * @package Alexandreo\DataBindr\Requests
 */
/**
 * Class HotelBindrRequest
 * @package Alexandreo\DataBindr\Requests
 */
class HotelBindrRequest extends KeyRequest
{

    /**
     * @var
     */
    private $country_id;

    /**
     * @var
     */
    private $name;

    /**
     * @var
     */
    private $address;

    /**
     * @var
     */
    private $category;

    /**
     * @var
     */
    private $town;

    /**
     * @var
     */
    private $zip;

    /**
     * @var
     */
    private $longitude;

    /**
     * @var
     */
    private $latitude;

    /**
     * @return mixed
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * @param mixed $country_id
     * @return HotelBindrRequest
     */
    public function setCountryId($country_id)
    {
        $country_id = strtoupper($country_id);

        if (strlen($country_id) == 2) {
            $countriesAlpha2 = CountriesArray::get('alpha2');
            if (!data_get($countriesAlpha2, $country_id)){
                throw new \InvalidArgumentException('invalid country_id.');
            }
        } else if(strlen($country_id) == 3) {
            $countriesAlpha3 = CountriesArray::get('alpha3', 'alpha2');
            if (data_get($countriesAlpha3, $country_id)){
                $country_id = data_get($countriesAlpha3, $country_id);
            } else{
                throw new \InvalidArgumentException('invalid country_id.');
            }
        } else {
            $countriesName = (new Collection(CountriesArray::get('alpha2', 'name')))->filter(function($value) use($country_id){
                return strtoupper($country_id) == strtoupper($value);
            });
            if ($countriesName->count() === 1){
                $country_id = (string)$countriesName->keys()->first();
            } else{
                throw new \InvalidArgumentException('invalid country_id.');
            }
        }
        $this->country_id = $country_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return HotelBindrRequest
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return HotelBindrRequest
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return HotelBindrRequest
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param mixed $town
     * @return HotelBindrRequest
     */
    public function setTown($town)
    {
        $this->town = $town;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     * @return HotelBindrRequest
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     * @return HotelBindrRequest
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     * @return HotelBindrRequest
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode([
            'key' => $this->getKey(),
            'country_id' => $this->getCountryId(),
            'name' => $this->getName(),
            'address' => $this->getAddress(),
            'category' => $this->getCategory(),
            'town' => $this->getTown(),
            'zip' => $this->getZip(),
            'longitude' => $this->getLongitude(),
            'latitude' => $this->getLatitude(),
        ]);
    }

}