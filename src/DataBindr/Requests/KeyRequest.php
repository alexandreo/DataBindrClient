<?php

namespace Alexandreo\DataBindr\Requests;

/**
 * Class KeyRequest
 * @package Alexandreo\DataBindr\Requests
 */
abstract class KeyRequest
{

    /**
     * @var string
     */
    private $key;

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return KeyRequest
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

}