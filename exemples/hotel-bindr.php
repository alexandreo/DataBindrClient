<?php
require '../vendor/autoload.php';

use Alexandreo\DataBindr\HotelBindr;

$hotelBindr = new HotelBindr(['key' => 'PLACE YOUR SECURITY KEY HERE']);
//$hotelBindr = new HotelBindr(['key' => 'Nb2ueEuEhbDvM9r8']);

$requests = [
    [
        'country_id' => 'USA',// u can send Alpha2, Alpha3 or Country Name.
        'name' => 'RAMADA HIALEAH/MIAMI AIRPORT NORTH',
        'address' => '1950 W 49TH STREET, HIALEAH, FLÓRIDA, ESTADOS UNIDOS DA AMÉRICA',
        'category' => '***',
        'town' => 'Miami',
        'zip' => '33012'
    ],
    [
        'country_id' => 'USA',// u can send Alpha2, Alpha3 or Country Name.
        'name' => 'RAMADA HIALEAH/MIAMI AIRPORT NORTH',
        'address' => '1950 W 49TH STREET, HIALEAH, FLÓRIDA, ESTADOS UNIDOS DA AMÉRICA',
        'category' => '***',
        'town' => 'Miami',
        'zip' => '33012'
    ],
    [
        'country_id' => 'USA',// u can send Alpha2, Alpha3 or Country Name.
        'name' => 'RAMADA HIALEAH/MIAMI AIRPORT NORTH',
        'address' => '1950 W 49TH STREET, HIALEAH, FLÓRIDA, ESTADOS UNIDOS DA AMÉRICA',
        'category' => '***',
        'town' => 'Miami',
        'zip' => '33012'
    ]
];

$hotelBindrRequests = $hotelBindr->hotelbindr($requests);


$hotelBindrRequests->each(function($hotelBindrRequest) {

    if ($hotelBindrRequest->isError()) {
        //show error
        echo $hotelBindrRequest->getErrorReason();
    } else {
        //prints BIND ID
        echo $hotelBindrRequest->getBindId();
        echo $hotelBindrRequest;

        //show request
        echo $hotelBindrRequest->getHotelBindrRequest()->getName();
    }
});
####################################################
foreach ($hotelBindrRequests as $hotelBindrRequest){
    if ($hotelBindrRequest->isError()) {
        //show error
        echo $hotelBindrRequest->getErrorReason();
    } else {
        //prints BIND ID
        echo $hotelBindrRequest->getBindId();
        echo $hotelBindrRequest;

        //show request
        echo $hotelBindrRequest->getHotelBindrRequest()->getName();
    }
}
