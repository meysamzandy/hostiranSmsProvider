<?php

namespace MeysamZnd\HostiranSmsProvider\Interfaces;

interface Sms
{
    public function send(string $url, array $data): array;
}
