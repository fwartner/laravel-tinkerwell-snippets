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
    private $token;

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
     * @return string
     */
    public function generateNewToken()
    {
        $response = $this->client->post($this->baseURL . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => config('tinkerwell-snippets.client_id'),
                'client_secret' => config('tinkerwell-snippets.client_secret'),
            ],
        ]);

        $this->token = json_decode((string) $response->getBody(), true)['access_token'];
        return $this->token;
    }

    /**
     * @return mixed
     */
    public function getSnippets()
    {
        $this->generateNewToken();
        $response = $this->client->request('GET', $this->baseURL . '/api/snippets', [
            'headers' => [
                'Accept' => 'application/json',
                "Authorization" => "Bearer {$this->token}",
            ],
        ]);

        return json_decode($response->getBody(), true)['data'];
    }
}
