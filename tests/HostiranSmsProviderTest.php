<?php

namespace MeysamZnd\HostiranSmsProvider\Tests;

use MeysamZnd\HostiranSmsProvider\Facades\HostiranSmsProvider;
use MeysamZnd\HostiranSmsProvider\ServiceProvider;
use Orchestra\Testbench\TestCase;

class HostiranSmsProviderTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'hostiran-sms-provider' => HostiranSmsProvider::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
