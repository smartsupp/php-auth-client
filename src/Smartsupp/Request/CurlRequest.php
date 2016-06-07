<?php
namespace Smartsupp\Request;

/**
 * Class CurlRequest implements basic functionality to handle CURL requests.
 * It is used to better mock this communication in PHPUnit tests.
 *
 * @package Smartsupp\Request
 */
class CurlRequest implements HttpRequest
{
    /**
     * Curl handler resource.
     *
     * @var null|resource
     */
    private $handle = null;

    /**
     * CurlRequest constructor.
     *
     * @param $url URL address to make call for
     */
    public function __construct($url) {
        $this->handle = curl_init($url);
    }

    /**
     * Set CURL option with given value.
     *
     * @param string $name option name
     * @param string $value option value
     */
    public function setOption($name, $value) {
        curl_setopt($this->handle, $name, $value);
    }

    /**
     * Execute CURL request.
     *
     * @return boolean
     */
    public function execute() {
        return curl_exec($this->handle);
    }

    /**
     * Get array of information about last request.
     *
     * @param string $name request handler
     * @return array info array
     */
    public function getInfo($name) {
        return curl_getinfo($this->handle, $name);
    }

    /**
     * Close CURL handler connection.
     */
    public function close() {
        curl_close($this->handle);
    }
}
