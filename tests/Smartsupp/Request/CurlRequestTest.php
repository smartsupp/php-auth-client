<?php
namespace Smartsupp\Request;

class CurlRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CurlRequest
     */
    protected $curl;

    protected function setUp()
    {
        parent::setUp();

        $this->curl = new CurlRequest('https://www.smartsupp.com/cs/features');
    }

    public function test_constructorVoid()
    {
        $this->curl = new CurlRequest();

        $this->assertInstanceOf('Smartsupp\Request\CurlRequest', $this->curl);
    }

    public function test_constructorUrl()
    {
        $this->curl = new CurlRequest('https://smartsupp.com');

        $this->assertInstanceOf('Smartsupp\Request\CurlRequest', $this->curl);
    }

    public function test_initError()
    {
        $this->curl->init('https://smartsupp.com');
    }

    public function test_setOption()
    {
        $this->curl->setOption(CURLOPT_HEADER, 0);
    }

    /**
     * @expectedExceptionMessage curl_setopt() expects parameter 1 to be resource, null given
     */
    public function test_setOption_notInitialized()
    {
        $this->curl->setOption(CURLOPT_HEADER, 0);
    }

    public function test_close()
    {
        $this->curl->close();
    }

    public function test_execute()
    {
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, TRUE);
        $this->assertNotEmpty($this->curl->execute());
    }

    public function test_getInfo()
    {
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, TRUE);
        $this->curl->execute();
        $this->assertEquals($this->curl->getInfo(CURLINFO_HTTP_CODE), 200);
    }

    public function test_getLastErrorMessage()
    {
        $this->curl->setOption(CURLOPT_URL, 'foo://bar');
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, TRUE);
        $this->curl->execute();
        $this->assertEquals(
            $this->curl->getLastErrorMessage(),
            'cURL failed with error #1: Protocol foo not supported or disabled in libcurl'
        );
    }
}