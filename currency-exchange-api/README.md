<h1 align="center">Laravel Currency Exchange API</h1>


## Overview

A simple Laravel application used for interacting with the [exchangeratesapi.io](http://exchangeratesapi.io) API. 'Laravel Currency Exchange API'
allow you to get the latest exchange rates and convert monetary values between different currencies.

## Requirements

The application has been developed and tested to work with the following minimum requirements:

- PHP 8
- Laravel 8

## Getting Your API Key

As of 1st April 2021, the exchangeratesapi.io now requires an API key to use the service. To get an API key, head over to
[https://exchangeratesapi.io/pricing](https://exchangeratesapi.io/pricing). You can sign up for free or use the paid tiers.

Please note that at the time of writing this, you will need to be on at least the 'Basic' plan to make request via HTTPS.  
You will also be required to have at least the 'Basic' paid plan to use ` exchange() ` method offered by
this application due to the fact that the free plan does not allow setting a base currency when converting.

Free key to test: 0b44d364dcfef4bcd08e502ebfe67e45

## Endpoints

Latest Rates Endpoint:

``` php
http://localhost:8000/api/v1/currencies
    ? access_key = API_KEY
    & base = BASE
    & symbols = SYMBOLS
```
Example:

``` php
http://localhost:8000/api/v1/currencies?access_key=0b44d364dcfef4bcd08e502ebfe67e45&base=EUR&symbols=AUD,BRL,CAD,CHF,GBP,JPY,USD
```
Request Parameters:

|Parameter  |Description                                                                            |
|-----------|---------------------------------------------------------------------------------------|
|access_key |[required] Your API Key.                                                               |
|base       |[optional] Enter the three-letter currency code of your preferred base currency.       |
|symbols    |[optional] Enter a list of comma-separated currency codes to limit output currencies.  |

</br>
</br>

Exchange Endpoint:

``` php
http://localhost:8000/api/v1/currencies/exchange
    ? access_key = API_KEY
    & from = FROM
    & to = TO
    & amount = AMOUNT
```
Example:

``` php
http://localhost:8000/api/v1/currencies/exchange?access_key=0b44d364dcfef4bcd08e502ebfe67e45&from=GBP&to=JPY&amount=25
```
Request Parameters:

|Parameter  |Description                                                                                |
|-----------|-------------------------------------------------------------------------------------------|
|access_key |[required] Your API Key.                                                                   |
|from       |[required] The three-letter currency code of the currency you would like to convert from.  |
|to         |[required] The three-letter currency code of the currency you would like to convert to.    |
|amount     |[required] The amount to be converted.                                                     |

</br>

A Postman Collection is available at the root of the project.

## Start server

Use the following command on the project folder:

```bash
php artisan serve
```

