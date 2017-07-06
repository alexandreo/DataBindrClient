<?php

namespace Alexandreo\DataBindr;

use Alexandreo\DataBindr\Requests\HotelBindrRequest;
use GuzzleHttp\Client;
use Alexandreo\DataBindr\Constants\ApiDataBindConstant;
use Illuminate\Support\Collection;

/**
 * Class HotelBindrClient
 * @package Alexandreo\DataBindr
 */
class HotelBindrClient
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $apiDataBindConstant = [];

    /**
     * HotelBindrClient constructor.
     * @param bool $https
     */
    public function __construct($https = true)
    {
        $this->apiDataBindConstant = ApiDataBindConstant::getConstants();

        $this->client = new Client([
            'base_uri' => ($https == true ? 'https://' : 'http://') . data_get($this->apiDataBindConstant, 'URI'),
            'headers'  => [
                'Content-Type' => 'application/json; charset=utf-8'
            ],
        ]);

    }

    /**
     * @param HotelBindrRequest $hotelBindrRequest
     * @return bool|mixed
     * @throws HotelBindrException
     */
    public function hotelbindr(HotelBindrRequest $hotelBindrRequest)
    {
        try {
            $hotelbindr = $this->client->post('hotelbindr', [
                'body' => $hotelBindrRequest->toJson()
            ]);
            return data_get(json_decode((string)$hotelbindr->getBody()), 'bind_id');
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw new HotelBindrException(data_get($this->apiDataBindConstant, 'HTTP_' . $e->getCode()));
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            throw new HotelBindrException(data_get($this->apiDataBindConstant, 'HTTP_' . $e->getCode()));
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw new HotelBindrException(data_get($this->apiDataBindConstant, 'HTTP_' . $e->getCode()));
        } catch (\GuzzleHttp\Exception\SeekException $e) {
            throw new HotelBindrException(data_get($this->apiDataBindConstant, 'HTTP_' . $e->getCode()));
        } catch (\GuzzleHttp\Exception\TooManyRedirectsException $e) {
            throw new HotelBindrException(data_get($this->apiDataBindConstant, 'HTTP_' . $e->getCode()));
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            throw new HotelBindrException(data_get($this->apiDataBindConstant, 'HTTP_' . $e->getCode()));
        }

        return false;
    }

}