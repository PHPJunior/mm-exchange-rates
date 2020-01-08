<?php


namespace PhpJunior\ExchangeRates;


use GuzzleHttp\Client;

class RequestBuilder
{
    /** @var string */
    private $baseUrl = 'http://forex.cbm.gov.mm/api';
    /**
     * @var Client
     */
    private $client;
    /**
     * RequestBuilder constructor.
     *
     * @param  Client|null  $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * @param string $path
     * @return mixed
     */
    public function makeRequest(string $path)
    {
        $url = $this->baseUrl.$path;
        return json_decode($this->client->get($url)->getBody()->getContents(), true);
    }
}
