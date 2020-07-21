<?php

namespace MeysamZnd\HostiranSmsProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__.'/../config/hostiran-sms-provider.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('hostiran-sms-provider.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'hostiran-sms-provider'
        );

        $this->app->bind('hostiran-sms-provider', function () {
            return new HostiranSmsProvider();
        });
    }
}
