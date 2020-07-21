<?php

namespace MeysamZnd\HostiranSmsProvider;

use MeysamZnd\HostiranSmsProvider\Interfaces\Sms;

class HostiranSmsProvider
{
    protected $send;

    /**
     * HostiranSmsProvider constructor.
     * @param Sms $send
     */
    public function __construct(Sms $send = null)
    {
        $this->send = $send;
    }

    /**
     * @param string $url
     * @param array $data
     * @return array
     */
    public function send(string $url, array $data): array
    {
        return $this->send->send($url, $data);
    }
}
