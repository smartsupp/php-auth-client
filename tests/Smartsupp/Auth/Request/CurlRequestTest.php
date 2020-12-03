<?php
namespace Smartsupp\Auth\Request;

use PHPUnit\Framework\TestCase;

class CurlRequestTest extends TestCase
{
    /**
     * @var CurlRequest
     */
    protected $curl;

    protected function setUp(): void
    {
        parent::setUp();

        $this->curl = new CurlRequest('https://www.smartsupp.com/cs/product');
    }

    public function test_constructorVoid()
    {
        $this->curl = new CurlRequest();

        self::assertInstanceOf('Smartsupp\Auth\Request\CurlRequest', $this->curl);
    }

    public function test_constructorUrl()
    {
        $this->curl = new CurlRequest('https://smartsupp.com');

        self::assertInstanceOf('Smartsupp\Auth\Request\CurlRequest', $this->curl);
    }

    public function test_setOption()
    {
        try {
            $this->curl->setOption(CURLOPT_HEADER, 0);
            self::assertTrue(true);
        } catch (\Throwable $e) {
            self::assertTrue(false);
        }
    }

    public function test_close()
    {
        try {
            $this->curl->close();
            self::assertTrue(true);
        } catch (\Throwable $e) {
            self::assertTrue(false);
        }
    }

    public function test_execute()
    {
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, TRUE);
        self::assertNotEmpty($this->curl->execute());
    }

    public function test_getInfo()
    {
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, TRUE);
        $this->curl->execute();
        self::assertEquals(200, $this->curl->getInfo(CURLINFO_HTTP_CODE));
    }

    public function test_getLastErrorMessage()
    {
        $this->curl->setOption(CURLOPT_URL, 'foo://bar');
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, TRUE);
        $this->curl->execute();
        self::assertNotEmpty($this->curl->getLastErrorMessage());
    }
}
