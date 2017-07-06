<?php

namespace Alexandreo\DataBindr;

use Alexandreo\DataBindr\Requests\HotelBindrRequest;



/**
 * Class DataBindr
 * @package Alexandreo\DataBindr
 */
class HotelBindr
{

    /**
     * @var string
     */
    protected $key = '';

    /**
     * @var HotelBindrClient|null
     */
    private $hotelBindrClient = null;

    /**
     * DataBindr constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!data_get($config, 'key')) {
            throw new \InvalidArgumentException('The key can not be empty.');
        }

        $this->key = (string)data_get($config, 'key');
        $this->hotelBindrClient = new HotelBindrClient((bool)data_get($config, 'ssl'));
    }

    public function hotelbindr($request)
    {
        if ($request instanceof HotelBindrRequest || is_array($request)) {
            $hotelBindrRequest = is_array($request) ? $this->transformRequestArrayToObject($request) : $request;
        } else {
            throw new \InvalidArgumentException('Invalid Request');
        }

        $a = $this->hotelBindrClient->hotelbindr($hotelBindrRequest);
        dd($a);
    }

    private function transformRequestArrayToObject(array $request)
    {
        $hotelBindrRequest = new HotelBindrRequest();
        $hotelBindrRequest->setKey($this->key);
        $hotelBindrRequest->setCountryId(data_get($request, 'country_id'));
        $hotelBindrRequest->setName(data_get($request, 'name'));
        $hotelBindrRequest->setAddress(data_get($request, 'address'));
        $hotelBindrRequest->setCategory(data_get($request, 'category'));
        $hotelBindrRequest->setTown(data_get($request, 'town'));
        $hotelBindrRequest->setZip(data_get($request, 'zip'));
        $hotelBindrRequest->setLongitude(data_get($request, 'longitude'));
        $hotelBindrRequest->setLatitude(data_get($request, 'latitude'));
        return $hotelBindrRequest;
    }

}