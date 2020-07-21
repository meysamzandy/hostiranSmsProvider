<?php

namespace MeysamZnd\HostiranSmsProvider;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use MeysamZnd\HostiranSmsProvider\Interfaces\Sms;

class ToOne implements Sms
{
    public function __construct()
    {
    }

    /**
     * @param string $url
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public function send(string $url, array $data): array
    {
        try {
            $client = new Client();
            $request = $client->post($url, ['json' => $data]);
            $response = [
                'status' => true,
                'providerResult' => json_decode($request->getBody()->getContents(), true),
            ];
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'providerResult' => $e->getMessage(),
            ];
        }

        return $response;
    }
}
