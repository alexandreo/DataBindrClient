# Data Bindr Client
 
Project for integration with databindr (Hotel Mapping).

## Install
### Composer
```
"alexandreo/data-bindr": "^1.0"
```
##Integration documentation with the Databindr
https://www.databindr.com/#!/docs


## How to use
```php
require 'vendor/autoload.php';

use Alexandreo\DataBindr\HotelBindr;

$hotelBindr = new HotelBindr(['key' => 'PLACE YOUR SECURITY KEY HERE']);

try {
    $bind_id = $hotelBindr->hotelbindr([
        'country_id' => 'USA',// u can send Alpha2, Alpha3 or Country Name.
        'name' => 'RAMADA HIALEAH/MIAMI AIRPORT NORTH',
        'address' => '1950 W 49TH STREET, HIALEAH, FLÓRIDA, ESTADOS UNIDOS DA AMÉRICA',
        'category' => '***',
        'town' => 'Miami',
        'zip' => '33012'
    ]);
    //
    echo $bind_id;
} catch (Alexandreo\DataBindr\HotelBindrException $e) {
    //Exception here
    dd($e->getMessage());
}



```
##Exemples
https://github.com/alexandreo/DataBindrClient/blob/master/exemples/

