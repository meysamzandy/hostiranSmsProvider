<?php

namespace MeysamZnd\HostiranSmsProvider;

use MeysamZnd\HostiranSmsProvider\Interfaces\Sms;
use SoapClient;

class ToMany implements Sms
{
    public function __construct()
    {
    }

    public function send(string $url, array $data): array
    {
        ini_set('soap.wsdl_cache_enabled', '0');
        try {
            $client = new SoapClient($url, ['encoding' => 'UTF-8']);
            $response = [
                'status' => true,
                'providerResult' => $client->AddSchedule($data),
            ];
        } catch (\SoapFault $sf) {
            $response = [
                'status' => false,
                'providerResult' => $sf->getMessage(),
            ];
        }

        return $response;
    }
}
