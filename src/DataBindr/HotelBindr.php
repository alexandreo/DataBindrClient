<?php

namespace Alexandreo\DataBindr;

use Alexandreo\DataBindr\Requests\HotelBindrRequest;
use Illuminate\Support\Collection;

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

    /**
     * @param $request
     * @return \Illuminate\Support\Collection
     */
    public function hotelbindr(array $requests)
    {
        $hotelBindrRequest = new Collection();
        foreach ($requests as $request) {
            $hotelBindrRequest[] = is_array($request) ? $this->transformRequestArrayToObject($request) : $request;
        }

        if ($hotelBindrRequest->count() === 0)
            throw new \InvalidArgumentException('Invalid Request');

        return $this->hotelBindrClient->hotelbindr($hotelBindrRequest);
    }

    /**
     * @param array $request
     * @return HotelBindrRequest
     */
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