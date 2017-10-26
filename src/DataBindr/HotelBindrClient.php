<?php

namespace Alexandreo\DataBindr;

use Alexandreo\DataBindr\Requests\HotelBindrRequest;
use Alexandreo\DataBindr\Constants\ApiDataBindConstant;
use Alexandreo\DataBindr\Responses\HotelBindrResponse;
use Amp\Artax\Request;
use Illuminate\Support\Collection;

use Amp\Loop;
use Amp\Promise;
use Amp\Artax\DefaultClient;

/**
 * Class HotelBindrClient
 * @package Alexandreo\DataBindr
 */
class HotelBindrClient
{

    /**
     * @var array
     */
    private $apiDataBindConstant = [];


    public function __construct()
    {
        $this->apiDataBindConstant = ApiDataBindConstant::getConstants();
    }

    /**
     * @param HotelBindrRequest $hotelBindrRequest
     * @return bool|mixed
     * @throws HotelBindrException
     */
    public function hotelbindr(Collection $hotelBindrRequest)
    {
        $dataBindrResponse = new Collection();
        Loop::run(function () use($hotelBindrRequest, &$dataBindrResponse) {
            $httpClient = new DefaultClient;
            $bodyRequest = $hotelBindrRequest->map(function($hotelBindrRequest){
                return $hotelBindrRequest->toJson();
            })->toArray();

            try {
                $responses = yield array_map(function ($request) use ($httpClient) {
                    $request = (new Request( data_get($this->apiDataBindConstant, 'URI') . '/hotelbindr', "POST"))
                        ->withHeader("Content-Type", "application/json; charset=utf-8")
                        ->withBody($request);
                    return $httpClient->request($request);
                }, $bodyRequest);

                foreach ($responses as $key => $response) {
                    $body = yield $response->getBody();
                    $dataBindrResponse[] = (new HotelBindrResponse)
                        ->setHotelBindrRequest($hotelBindrRequest[$key])
                        ->setBindId(data_get(json_decode((string)$body), 'bind_id'))
                        ->setError($response->getStatus() !== 200)
                        ->setErrorReason(data_get($this->apiDataBindConstant, 'HTTP_' . $response->getStatus()));
                }
            } catch (\Amp\MultiReasonException $e) {
                throw new HotelBindrException(data_get($this->apiDataBindConstant, 'HTTP_' . $e->getCode()));
            }
            Loop::stop();
        });

        return $dataBindrResponse;
    }

}