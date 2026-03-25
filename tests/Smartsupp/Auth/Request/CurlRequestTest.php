<?php
namespace Smartsupp\Auth\Request;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use TypeError;

class CurlRequestTest extends TestCase
{
    private CurlRequest $curl;

    protected function setUp(): void
    {
        parent::setUp();

        $this->curl = new CurlRequest('https://www.smartsupp.com/cs/product');
    }

    public function test_constructorVoid(): void
    {
        $this->curl = new CurlRequest();

        $this->assertInstanceOf(CurlRequest::class, $this->curl);
    }

    public function test_constructorUrl(): void
    {
        $this->curl = new CurlRequest('https://smartsupp.com');

        $this->assertInstanceOf(CurlRequest::class, $this->curl);
    }

    public function test_initError(): void
    {
        $this->curl->init('https://smartsupp.com');
    }

    public function test_setOption(): void
    {
        $this->curl->setOption(CURLOPT_HEADER, 0);
    }

    public function test_setOption_notInitialized(): void
    {
        $curl = new CurlRequest();
        $handleProp = (new ReflectionClass($curl))->getProperty('handle');
        $handleProp->setAccessible(true);
        $handleProp->setValue($curl, null);

        $this->expectException(TypeError::class);
        $curl->setOption(CURLOPT_HEADER, 0);
    }

    public function test_close(): void
    {
        $this->curl->close();
    }

    public function test_execute(): void
    {
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, true);
        $this->assertNotEmpty($this->curl->execute());
    }

    public function test_getInfo(): void
    {
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, true);
        $this->curl->execute();
        $this->assertEquals(200, $this->curl->getInfo(CURLINFO_HTTP_CODE));
    }

    public function test_getLastErrorMessage(): void
    {
        $this->curl->setOption(CURLOPT_URL, 'foo://bar');
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, true);
        $this->curl->execute();
        $this->assertNotEmpty($this->curl->getLastErrorMessage());
    }
}
