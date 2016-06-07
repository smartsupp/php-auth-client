<?php
namespace Smartsupp\Request;

/**
 * Class CurlRequest implements basic functionality to handle cURL requests.
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
     * @param string|null $url URL address to make call for
     */
    public function __construct($url = null) {
        if ($url) {
            $this->handle = $this->init($url);
        }
    }

    /**
     * Init cURL connection object.
     *
     * @param string|null $url
     * @throws Exception
     */
    public function init($url = null) {
        $this->handle = curl_init($url);

        if ($this->handle === false) {
            throw new Exception('cURL failed to initialize.');
        }
    }

    /**
     * Set cURL option with given value.
     *
     * @param string $name option name
     * @param string $value option value
     */
    public function setOption($name, $value) {
        curl_setopt($this->handle, $name, $value);
    }

    /**
     * Execute cURL request.
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
     * Close cURL handler connection.
     */
    public function close() {
        curl_close($this->handle);
    }

    /**
     * Return last error message as string.
     *
     * @return string formatted error message
     */
    public function getLastErrorMessage()
    {
        $message = sprintf("cURL failed with error #%d: %s", curl_errno($this->handle), curl_error($this->handle));
        return $message;
    }
}
