<?php

namespace Alexandreo\DataBindr;

/**
 * Class ConstantTrait
 * @package Alexandreo\DataBindr
 */
trait ConstantTrait
{
    /**
     * @return array
     */
    static function getConstants() {
        $reflect = new \ReflectionClass(__CLASS__);
        return $reflect->getConstants();
    }

}
