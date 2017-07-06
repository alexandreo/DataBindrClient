<?php
require 'vendor/autoload.php';

use Alexandreo\DataBindr\HotelBindr;

$hotelBindr = new HotelBindr([
    'key' => 'NCA9E4mzfzfTCeBb'
]);

$hotelBindr->hotelbindr([
    'country_id' => 'USA',
    'name' => 'RAMADA HIALEAH/MIAMI AIRPORT NORTH',
    'address' => '1950 W 49TH STREET, HIALEAH, FLÓRIDA, ESTADOS UNIDOS DA AMÉRICA',
    'category' => '***',
    'town' => 'Miami',
    'zip' => '33012'
]);

dd($hotelBindr);