<?php
namespace Smartsupp;

use Smartsupp\Api\Api;
use ReflectionProperty;

class ApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Api
     */
    protected $api;

    protected function setUp()
    {
        parent::setUp();

        $this->api = new Api();
    }

    /**
     * Get private / protected field value using ReflectionProperty object.
     *
     * @static
     * @param mixed $object object to be used
     * @param string $fieldName object property name
     * @return mixed given property value
     */
    public static function getPrivateField($object, $fieldName)
    {
        $refId = new ReflectionProperty($object, $fieldName);
        $refId->setAccessible(true);
        $value = $refId->getValue($object);
        $refId->setAccessible(false);

        return $value;
    }
}
