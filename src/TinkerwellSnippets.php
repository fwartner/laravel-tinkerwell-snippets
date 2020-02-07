<?php

namespace Fwartner\TinkerwellSnippets;

use GuzzleHttp\Client;

class TinkerwellSnippets
{
    /**
     * @var Client
     */
    public $client;

    /**
     * @var string
     */
    private $baseURL = 'https://tinkerwell-snippets.com';

    /**
     * DatahouseService constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @return mixed
     */
    public function getSnippets()
    {
        $response = $this->client->request('GET', $this->baseURL . '/sapi/snippets', [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true)['data'];
    }
}
