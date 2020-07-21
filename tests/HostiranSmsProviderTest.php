<?php

namespace MeysamZnd\HostiranSmsProvider\Tests;

use MeysamZnd\HostiranSmsProvider\Facades\HostiranSmsProvider;
use MeysamZnd\HostiranSmsProvider\ServiceProvider;
use MeysamZnd\HostiranSmsProvider\ToMany;
use MeysamZnd\HostiranSmsProvider\ToOne;
use Mockery;

class HostiranSmsProviderTest extends \PHPUnit\Framework\TestCase
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


    public function testSendToOne()
    {
        Mockery::close();
        $mock = Mockery::mock('overload:'.ToOne::class, ['send' => [
            'status' => true,
            'providerResult' => [
                'Value' => '5120060601178765588',
                'RetStatus' => 1,
                'StrRetStatus' => 'Ok',
            ],
        ]]);
        self::assertInstanceOf(ToOne::class, $mock);

        $url = 'https://rest.payamak-panel.com/api/SendSMS/SendSMS';
        $data = [
            'username' => 'fake',
            'password' => 'fake',
            'from' => 'fake',
            'to' => 'fake',
            'text' => 'ToOne',
            'isflash' => false,
        ];
        $sender = new ToOne();
        $result = $sender->send($url, $data);

        self::assertTrue($result['status']);
        self::assertArrayHasKey('Value', $result['providerResult']);
        self::assertEquals(1, $result['providerResult']['RetStatus']);
        self::assertEquals('Ok', $result['providerResult']['StrRetStatus']);
        self::assertIsArray($result['providerResult']);
        Mockery::close();

        $mock1 = Mockery::mock('overload:'.ToOne::class, ['send' => [
            'status' => false,
            'providerResult' => 'fake message',
        ]])->makePartial();
        self::assertInstanceOf(ToOne::class, $mock1);
        //         false if variable has doesnt value
        $sender1 = (new ToOne())->send('', []);

        self::assertFalse($sender1['status']);
        self::assertIsNotArray($sender1['providerResult']);
        Mockery::close();


        $mock2 = Mockery::mock('overload:'.ToOne::class, ['send' => [
            'status' => true,
            'providerResult' => [
                'Value' => '5',
                'RetStatus' => 9,
                'StrRetStatus' => 'fake message',
            ],
        ]])->makePartial();
        self::assertInstanceOf(ToOne::class, $mock2);
        $url = 'https://rest.payamak-panel.com/api/SendSMS/SendSMS';
        $data = ['wrong data'];
        $sender2 = new ToOne();
        $result2 = $sender2->send($url, $data);
        self::assertTrue($result2['status']);
        self::assertArrayHasKey('Value', $result2['providerResult']);
        self::assertNotEquals(1, $result2['providerResult']['RetStatus']);
        self::assertNotEquals('Ok', $result2['providerResult']['StrRetStatus']);
        self::assertIsArray($result2['providerResult']);
    }

    public function testSendToMany()
    {
        Mockery::close();
        $mock = Mockery::mock('overload:'.ToMany::class, ['send' => [
            'status' => true,
            'providerResult' => [
                'AddScheduleResult' => '2336716',
            ],
        ]])->makePartial();
        self::assertInstanceOf(ToMany::class, $mock);
        $url = 'https://rest.payamak-panel.com/api/SendSMS/SendSMS';
        $data = [
            'username' => 'fake',
            'password' => 'fake',
            'from' => 'fake',
            'to' => 'fake',
            'text' => 'ToOne',
            'isflash' => false,
        ];
        $sender = new ToMany();
        $result = $sender->send($url, $data);
        self::assertTrue($result['status']);
        self::assertIsArray($result['providerResult']);
        self::assertArrayHasKey('AddScheduleResult', $result['providerResult']);
        self::assertGreaterThan(2, strlen($result['providerResult']['AddScheduleResult']));

        Mockery::close();

        $mock1 = Mockery::mock('overload:'.ToMany::class, ['send' => [
            'status' => false,
            'providerResult' => 'fake message',
        ]])->makePartial();
        self::assertInstanceOf(ToMany::class, $mock1);
        //         false if variable has doesnt value
        $sender = new ToMany();
        $result1 = $sender->send('', []);
        self::assertFalse($result1['status']);
        self::assertIsNotArray($result1['providerResult']);

        Mockery::close();

        $mock2 = Mockery::mock('overload:'.ToMany::class, ['send' => [
            'status' => true,
            'providerResult' => [
                'AddScheduleResult' => '0',
            ],
        ]])->makePartial();
        self::assertInstanceOf(ToMany::class, $mock2);
        $url = 'https://rest.payamak-panel.com/api/SendSMS/SendSMS';
        $data = ['wrong data'];
        $sender = new ToMany();
        $result = $sender->send($url, $data);
        self::assertTrue($result['status']);
        self::assertIsArray($result['providerResult']);
        self::assertArrayHasKey('AddScheduleResult', $result['providerResult']);
        self::assertLessThan(5, strlen($result['providerResult']['AddScheduleResult']));
    }
}
