<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CurrencyExchangeService
{
    # Default API URL:
    const API_URL_SSL = 'https://api.exchangeratesapi.io/';
    
    # Free plan API URL:
    const API_URL_NON_SSL = 'http://api.exchangeratesapi.io/';

    # The URL of the API:
    private $apiURL = self::API_URL_NON_SSL;

    # ExchangeRatesAPI Access Key:
    private $access_key;

    function __construct(string $access_key = null, bool $use_ssl = false)
    {
        $this->setAccessKey($access_key);
        $this->setUseSSL($use_ssl);    
        $this->client = new Client([ 'base_uri' => $this->apiURL ]);
    }

    # Get currencies
    public function getCurrencies(Request $request)
    {
        $endpoint = 'latest';
        $params = $this->getCurrenciesParams($request);
        return $this->responseFormat($this->get($endpoint, $params));
    }

    # Currency exchange
    public function exchange(Request $request)
    {
        $endpoint = 'convert';
        $params = $this->convertParams($request);
        return $this->get($endpoint, $params);
    }

    # Http get and json decode
    private function get(string $endpoint, array $params)
    {
        try
        {
            $response = $this->client->request('GET', $endpoint, [ 'query' => $params ]);
            return json_decode($response->getBody(), true);
        }
        catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }

    # Params for getCurrencies method
    private function getCurrenciesParams(Request $request)
    {
        $params = [ ];

        # Set access key:
        if(!is_null($this->getAccessKey()))
        {
            $params['access_key'] = $this->getAccessKey();
        }

        # Set the base currency:
        if(!is_null($request->query('base')))
        {
            $params['base'] = $request->query('base');
        }
        
        # Set symbols:
        if(!is_null($request->query('symbols')))
        {
            $params['symbols'] = $request->query('symbols');
        }

        return $params;
    }

    # Params for exchange method
    private function convertParams(Request $request)
    {
        $params = [ ];

        # Set access key:
        if(!is_null($this->getAccessKey()))
        {
            $params['access_key'] = $this->getAccessKey();
        }

        # Set currency from:
        if(!is_null($request->query('from')))
        {
            $params['from'] = $request->query('from');
        }
        
        # Set currency to:
        if(!is_null($request->query('to')))
        {
            $params['to'] = $request->query('to');
        }

        # Set amount:
        if(!is_null($request->query('amount')))
        {
            $params['amount'] = $request->query('amount');
        }

        return $params;
    }

    # Get ExchangeRatesAPI access key
    public function getAccessKey()
    {
        return $this->access_key;
    }
    
    # Get use ssl
    public function getUseSSL()
    {
        return ($this->apiURL == self::API_URL_SSL);
    }

    # Set ExchangeRatesAPI access key
    public function setAccessKey(string $access_key = null)
    {
        $this->access_key = $access_key;
        
        return $this;
    }

    # Set use ssl
    public function setUseSSL(bool $use_ssl = true)
    {
        if($use_ssl)
        {
            $this->apiURL = self::API_URL_SSL;
        }
        else
        {
            $this->apiURL = self::API_URL_NON_SSL;
        }
        
        return $this;
    }

    # Response format
    private function responseFormat(array $response)
    {
        $resp = [];

        foreach($response as $key=>$value)
        {
            # Set base currency
            if($key == 'base')
            {
                $resp[$value] = $key;
            }

            # Set rates
            if($key == 'rates')
            {
                foreach($value as $keyRate=>$valueRate)
                { 
                    $resp[$keyRate] = $valueRate;
                }
            }
        }

        if(empty($resp))
        {
            return $response;
        }

        return $resp;
    }
}