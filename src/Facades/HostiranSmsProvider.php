<?php

namespace MeysamZnd\HostiranSmsProvider\Facades;

use Illuminate\Support\Facades\Facade;

class HostiranSmsProvider extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'hostiran-sms-provider';
    }
}
