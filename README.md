# Hostiran Sms Provider

[![GitHub Workflow Status](https://github.com/meysamzandy/hostiranSmsProvider/workflows/Run%20tests/badge.svg)](https://github.com/meysamzandy/hostiranSmsProvider/actions)
[![styleci](https://styleci.io/repos/281369503/shield)](https://styleci.io/repos/281369503)


[![Packagist](https://img.shields.io/packagist/v/meysam-znd/hostiran-sms-provider.svg)](https://packagist.org/packages/meysam-znd/hostiran-sms-provider)
[![Packagist](https://poser.pugx.org/meysam-znd/hostiran-sms-provider/d/total.svg)](https://packagist.org/packages/meysam-znd/hostiran-sms-provider)
[![Packagist](https://img.shields.io/packagist/l/meysam-znd/hostiran-sms-provider.svg)](https://packagist.org/packages/meysam-znd/hostiran-sms-provider)


Package description: HostIran SMS sender package for laravel

## Installation

Install via composer
```bash
composer require meysam-znd/hostiran-sms-provider
```

### Publish package assets

```bash
php artisan vendor:publish --provider="MeysamZnd\HostiranSmsProvider\ServiceProvider"
```

## Usage

### Send sms to one number or few numbers
##### for sending sms to few numbers, separate those numbers with ", " as a string.

```bash
use MeysamZnd\HostiranSmsProvider\HostiranSmsProvider;
use MeysamZnd\HostiranSmsProvider\ToOne;

$url = 'https://rest.payamak-panel.com/api/SendSMS/SendSMS';
$data = [
    'username' => 'your username',
    'password' => 'your password',
    'from' => 'sender number',
    'to' => 'receiver numbers',
    'text' => 'your text message',
    'isflash' => false,
    ];

    $sender = new HostiranSmsProvider(new ToOne()) ;

    // send and get the result
    dd ( $sender->send($url, $data) );

```
### Send sms to one, or  many numbers with schedule
##### for sending sms to few numbers, separate those numbers with ", " as a string.

```bash
use MeysamZnd\HostiranSmsProvider\HostiranSmsProvider;
use MeysamZnd\HostiranSmsProvider\ToMany;
use MeysamZnd\HostiranSmsProvider\ToOne;

$url = 'http://api.payamak-panel.com/post/schedule.asmx?wsdl';
$data = [
    'username' => 'your username',
    'password' => 'your password',
    'from' => 'sender number',
    'to' => 'receiver numbers',
    'text' => 'your text message',
    'isflash' => false,
    'scheduleDateTime' => 'your time',
    'period' => 'Once',
    ];

    $sender = new HostiranSmsProvider(new ToMany()) ;

    // send and get the result
    dd ( $sender->send($url, $data) );

```
## Security

If you discover any security related issues, please email
instead of using the issue tracker.

## Credits

- [Meysam Zandy](https://github.com/meysam-znd/hostiran-sms-provider)
- [All contributors](https://github.com/meysam-znd/hostiran-sms-provider/graphs/contributors)

This package is bootstrapped with the help of
[melihovv/laravel-package-generator](https://github.com/melihovv/laravel-package-generator).
