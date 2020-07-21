<?php

namespace MeysamZnd\HostiranSmsProvider;

use MeysamZnd\HostiranSmsProvider\Interfaces\Sms;

class HostiranSmsProvider
{
    protected $send;

    public function __construct(Sms $send)
    {
        $this->send = $send;
    }

    public function send(string $url, array $data): array
    {
        return $this->send->send($url, $data);
    }
}
