# Laravel MegaSubPlug

[![Latest Version on Packagist](https://img.shields.io/packagist/v/henryejemuta/laravel-megasubplugplug.svg?style=flat-square)](https://packagist.org/packages/henryejemuta/laravel-megasupplug)
[![Latest Stable Version](https://poser.pugx.org/henryejemuta/laravel-megasupplug/v/stable)](https://packagist.org/packages/henryejemuta/laravel-megasupplug)
[![Total Downloads](https://poser.pugx.org/henryejemuta/laravel-megasupplug/downloads)](https://packagist.org/packages/henryejemuta/laravel-megasupplug)
[![License](https://poser.pugx.org/henryejemuta/laravel-megasupplug/license)](https://packagist.org/packages/henryejemuta/laravel-megasupplug)
[![Quality Score](https://img.shields.io/scrutinizer/g/henryejemuta/laravel-megasupplug.svg?style=flat-square)](https://scrutinizer-ci.com/g/henryejemuta/laravel-megasupplug)

## What is MegaSubPlug
The MegaSubPlug API allows you to integrate all virtual top-up and bills payment services available on the MegaSubPlug platform with your application (websites, desktop apps & mobile apps). You can also start your own VTU business by integrating this API and resell MegaSubPlug services in Nigeria.

## What is Laravel MegaSubPlug
Laravel MegaSubPlug is a laravel package to seamlessly integrate MegaSubPlug api within your laravel application.

Create a MegaSubPlug Account [Sign Up](https://megasubplug.com/Register/).

Look up MegaSubPlug API Documentation [API Documentation](./mega-sub-plug-apidocs.pdf).
The Updated Mega-Sub Api Documentation is now part of the repository, as there seems to be broken links finding it on their dashboard

## Installation

You can install the package via composer:

```bash
composer require henryejemuta/laravel-megasubplug
```

Publish MegaSubPlug configuration file, migrations as well as set default details in .env file:

```bash
php artisan megasubplug:init
```

## Usage

**Important: Kindly use the ``$response->successful()`` to check the response state before proceeding with working with the response and gracefully throw and handle the MegaSubPlugErrorException on failed request**

Before initiating any transaction kindly check your balance to confirm you have enough MegaSubPlug balance to handle the transaction

The Laravel MegaSubPlug Package is quite easy to use via the MegaSubPlug facade
``` php
use HenryEjemuta\LaravelMegaSubPlug\Facades\MegaSubPlug;
use HenryEjemuta\LaravelMegaSubPlug\Classes\MegaSubPlugResponse;

...

//To buy Airtime
try{
    $response = MegaSubPlugFacade::buyAirtime(NetworkEnum::getNetwork('mtn'), 100, '08134567890');
} catch (MegaSubPlugErrorException $exception) {
    Log::error($exception->getMessage() . "\n\r" . $exception->getCode());
}

//A dump of the MegaSubPlugResponse on successful airtime purchase
HenryEjemuta\LaravelMegaSubPlug\Classes\MegaSubPlugResponse {#1423 ▼
  -message: ""
  -hasError: false
  -error: null
  -code: 200
  -body: {#1539 ▼
    +"id": 167630
    +"airtime_type": "VTU"
    +"network": 1
    +"paid_amount": "97.0"
    +"mobile_number": "08134567890"
    +"amount": "100"
    +"plan_amount": "₦100"
    +"plan_network": "MTN"
    +"balance_before": "2892.6"
    +"balance_after": "2795.6"
    +"Status": "successful"
    +"create_date": "2021-08-28T21:02:54.311846"
    +"Ported_number": true
  }
}



//To buy Data Bundle
try{
    $response = MegaSubPlugFacade::buyData(MegaSubPlugNetworkEnum::getNetwork("mtn"), 7, "08134567890");
} catch (MegaSubPlugErrorException $exception) {
    Log::error($exception->getMessage() . "\n\r" . $exception->getCode());
}

//A dump of the MegaSubPlugResponse on successful data purchase
HenryEjemuta\LaravelMegaSubPlug\Classes\MegaSubPlugResponse {#1423 ▼
  -message: ""
  -hasError: false
  -error: null
  -code: 200
  -body: {#1539 ▼
    +"id": 108602
    +"network": 1
    +"balance_before": "2698.6"
    +"balance_after": "2459.6"
    +"mobile_number": "08134567890"
    +"plan": 7
    +"Status": "successful"
    +"plan_network": "MTN"
    +"plan_name": "1.0GB"
    +"plan_amount": "₦239.0"
    +"create_date": "2021-08-28T21:27:41.169631"
    +"Ported_number": true
  }
}
...

```


Find an overview of all method with comment on what they do and expected arguments
``` php

       
    /**
     * Get Your MegaSub account details including available balance
     * @return MegaSubPlugResponse
     * @throws MegaSubPlugErrorException
     */
    public function checkUserDetails(): MegaSubPlugResponse

    /**
     * @param NetworkEnum $mobileNetwork
     * @param int $amount
     * @param $phoneNumber
     * @param bool $portedNumber
     * @param string $airtimeType
     * @return MegaSubPlugResponse
     * @throws MegaSubPlugErrorException
     */
    public function buyAirtime(NetworkEnum $mobileNetwork, int $amount, $phoneNumber, bool $portedNumber = true, string $airtimeType = "VTU"): MegaSubPlugResponse

    /**
     * MegaSubPlug API Transaction handler to access:
     * Transaction()->getAllDataTransaction(): MegaSubPlugResponse
     * Transaction()->queryDataTransaction(int $txnId): MegaSubPlugResponse
     * Transaction()->queryAirtimeTransaction(int $txnId): MegaSubPlugResponse
     * Transaction()->queryElectricityBillTransaction(int $txnId): MegaSubPlugResponse
     * Transaction()->queryCableTvTransaction(int $txnId): MegaSubPlugResponse
     *
     * @return Transaction
     */
    public function Transaction(): Transaction

    /**
     * Cable TV Bill handler to access:
     * CableTv()->verifyIUC(CableTvEnum $cableTv, $smartCardNo): MegaSubPlugResponse
     * CableTv()->purchasePackage(CableTvEnum $cableTv, string $package, $smartCardNo): MegaSubPlugResponse
     *
     * @return CableTv
     */
    public function CableTv(): CableTv


    /**
     * @param NetworkEnum $network
     * @param string $plan
     * @param string $phoneNumber
     * @param bool $portedNumber
     * @return MegaSubPlugResponse
     * @throws MegaSubPlugErrorException
     */
    public function buyData(NetworkEnum $network, string $plan, string $phoneNumber, bool $portedNumber = true): MegaSubPlugResponse


    /**
     * Electricity Bills payment handler to access:
     * Electricity()->verifyMeterNumber(DiscoEnum $disco, $meterNumber, MeterTypeEnum $meterType): MegaSubPlugResponse
     * Electricity()->buyElectricity(DiscoEnum $disco, $meterNumber, $amount, MeterTypeEnum $meterType): MegaSubPlugResponse
     *
     * @return Electricity
     */
    public function Electricity(): Electricity

```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email henry.ejemuta@gmail.com instead of using the issue tracker.

## Credits

- [Henry Ejemuta](https://github.com/henryejemuta)
- [All Contributors](https://github.com/henryejemuta/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
