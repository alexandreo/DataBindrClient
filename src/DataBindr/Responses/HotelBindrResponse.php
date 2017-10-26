<?php

namespace Alexandreo\DataBindr\Responses;

use Alexandreo\DataBindr\Requests\HotelBindrRequest;

class HotelBindrResponse
{

    private $hotelBindrRequest;

    private $bind_id;

    private $error = false;

    private $errorReason;

    /**
     * @return mixed
     */
    public function getBindId()
    {
        return $this->bind_id;
    }

    /**
     * @param mixed $bind_id
     * @return HotelBindrResponse
     */
    public function setBindId($bind_id)
    {
        $this->bind_id = $bind_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHotelBindrRequest()
    {
        return $this->hotelBindrRequest;
    }

    /**
     * @param mixed $hotelBindrRequest
     * @return HotelBindrResponse
     */
    public function setHotelBindrRequest(HotelBindrRequest $hotelBindrRequest)
    {
        $this->hotelBindrRequest = $hotelBindrRequest;
        return $this;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return $this->error;
    }

    /**
     * @param bool $error
     * @return HotelBindrResponse
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorReason()
    {
        return $this->errorReason;
    }

    /**
     * @param mixed $errorReason
     * @return HotelBindrResponse
     */
    public function setErrorReason($errorReason)
    {
        $this->errorReason = $errorReason;
        return $this;
    }

    public function __toString()
    {
        return (string)$this->getBindId();
    }

}