<?php
namespace Smartsupp\Api;

use Exception;

if (!function_exists('curl_init')) {
    throw new Exception('Smartsupp API client needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('Smartsupp API client needs the JSON PHP extension.');
}

/**
 * Class to communicate with Smartsupp parner API
 *
 * PHP version >=5.3
 *
 * @package    Smartsupp
 * @author     Marek Gach <gach@kurzor.net>
 * @copyright  since 2016 SmartSupp.com
 * @version    Git: $Id$
 * @link       https://github.com/smartsupp/php-partner-client
 */
class Api
{
}
