<?php
namespace Smartsupp\Auth;

use Exception;
use PHPUnit\Framework\TestCase;
use Smartsupp\Auth\Request\HttpRequest;

class ApiTest extends TestCase
{
    public function test_constructor(): void
    {
        $api = new Api();
        $this->assertNotNull($api);
    }

    public function test_login(): void
    {
        $data = array(
            'email' => 'test5@kurzor.net',
            'password' => 'xxx'
        );

        $response = array(
            'account' => array(
                'key' => 'CHAT_KEY',
                'lang' => 'en'
            )
        );

        $http = $this->createMock(HttpRequest::class);
        $http->expects($this->any())
            ->method('execute')
            ->willReturn(json_encode($response));

        $api = new Api($http);
        $this->assertEquals($response, $api->login($data));
    }

    public function test_response_error(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Foo is at bar!');

        $data = array(
            'email' => 'test5@kurzor.net',
            'password' => 'xxx'
        );

        $http = $this->createMock(HttpRequest::class);
        $http->expects($this->any())
            ->method('execute')
            ->willReturn(false);

        $http->expects($this->any())
            ->method('getLastErrorMessage')
            ->willReturn('Foo is at bar!');

        $api = new Api($http);
        $api->login($data);
    }

    public function test_create(): void
    {
        $data = array(
            'email' => 'LOGIN_EMAIL',
            'password' => 'YOUR_PASSWORD',
            'name' => 'John Doe',
            'lang' => 'en',
            'partnerKey' => 'PARTNER_API_KEY'
        );

        $response = array(
            'account' => array(
                'key' => 'CHAT_KEY',
                'lang' => 'en'
            ),
            'user' => array(
                'email' => 'LOGIN_EMAIL',
                'name' => 'John Doe',
                'password' => 'YOUR_PASSWORD'
            )
        );

        $http = $this->createMock(HttpRequest::class);
        $http->expects($this->any())
            ->method('execute')
            ->willReturn(json_encode($response));

        $api = new Api($http);
        $this->assertEquals($response, $api->create($data));
    }
}
