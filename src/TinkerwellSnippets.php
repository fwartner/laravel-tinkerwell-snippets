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
        $response = $this->client->post('https://test.devrite.co/oauth/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
//                'client_id' => config('tinkerwell-snippets.client_id'),
//                'client_secret' => config('tinkerwell-snippets.client_secret'),
                'client_id' => '3',
                'client_secret' => 'CQThpCpuHGlDN3fVl52m76RhtZ0V5TAsTIKpCM4P',
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
        $response = $this->client->request('GET', 'https://test.devrite.co/api/snippets', [
            'headers' => [
                'Accept' => 'application/json',
                "Authorization" => "Bearer {$this->token}",
            ],
        ]);

        return json_decode($response->getBody(), true)['data'];
    }
}
