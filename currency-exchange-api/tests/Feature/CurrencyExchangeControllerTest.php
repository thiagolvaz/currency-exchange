<?php

namespace Tests\Feature;

use Tests\TestCase;
use GuzzleHttp\Client;

class CurrencyExchangeControllerTest extends TestCase
{
    private $http;

    private $access_key;

    public function setUp(): void
    {
        $this->http = new Client(['base_uri' => 'http://localhost:8000/api/v1/']);
        $this->access_key = '0b44d364dcfef4bcd08e502ebfe67e45';
    }

    public function tearDown(): void
    {
        $this->http = null;
        $this->access_key = null;
    }

    public function testGetCurrencies()
    {
        $endpoint = 'latest';
        $params = $this->getCurrenciesParams();
        $response = $this->http->request('GET', $endpoint, [ 'query' => $params ]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testExchange()
    {
        $endpoint = 'exchange';
        $params = $this->exchangeParams();
        $response = $this->http->request('GET', $endpoint, [ 'query' => $params ]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    private function getCurrenciesParams()
    {
        $params = [ ];
        $params['access_key'] = $this->access_key;
        $params['base'] = 'EUR';
        $params['symbols'] = 'USD';
        return $params;
    }

    private function exchangeParams()
    {
        $params = [ ];
        $params['access_key'] = $this->access_key;
        $params['from'] = 'GBP';
        $params['to'] = 'JPY';
        $params['amount'] = '50';
        return $params;
    }
}
