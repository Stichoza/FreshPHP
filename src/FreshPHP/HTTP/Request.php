<?php

namespace FreshPHP\HTTP;
use FreshPHP\Singleton\Singleton;

/**
 * Class Request
 * @package FreshPHP\HTTP
 * @author Stichoza <me@stichoza.com>
 */
class Request extends Singleton {

    protected static $HTTPErrorCodes = array(
        100 => "Continue",
        101 => "Switching Protocols",
        102 => "Processing",
        200 => "OK",
        201 => "Created",
        202 => "Accepted",
        203 => "Non-Authoritative Information",
        204 => "No Content",
        205 => "Reset Content",
        206 => "Partial Content",
        207 => "Multi-Status",
        300 => "Multiple Choices",
        301 => "Moved Permanently",
        302 => "Moved Temporarily",
        303 => "See Other",
        304 => "Not Modified",
        305 => "Use Proxy",
        306 => "(Unused)",
        307 => "Temporary Redirect",
        308 => "Permanent Redirect",
        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
        406 => "Not Acceptable",
        407 => "Proxy Authentication Required",
        408 => "Request Timeout",
        409 => "Conflict",
        410 => "Gone",
        411 => "Length Required",
        412 => "Precondition Failed",
        413 => "Request Entity Too Large",
        414 => "Request-URI Too Long",
        415 => "Unsupported Media Type",
        416 => "Requested Range Not Satisfiable",
        417 => "Expectation Failed",
        418 => "I'm a teapot", // LOL
        419 => "Authentication Timeout",
        420 => "Enhance Your Calm", // LOL
        422 => "Unprocessable Entity",
        423 => "Locked",
        424 => "Failed Dependency", // TODO Check this
        425 => "Unordered Collection",
        426 => "Upgrade Required",
        428 => "Precondition Required",
        429 => "Too Many Requests",
        431 => "Request Header Fields Too Large",
        444 => "No Response",
        449 => "Retry With",
        450 => "Blocked by Windows Parental Controls",
        451 => "Unavailable For Legal Reasons",
        494 => "Request Header Too Large",
        495 => "Cert Error",
        496 => "No Cert",
        497 => "HTTP to HTTPS",
        499 => "Client Closed Request",
        500 => "Internal Server Error",
        501 => "Not Implemented",
        502 => "Bad Gateway",
        503 => "Service Unavailable",
        504 => "Gateway Timeout",
        505 => "HTTP Version Not Supported",
        506 => "Variant Also Negotiates",
        507 => "Insufficient Storage",
        508 => "Loop Detected",
        509 => "Bandwidth Limit Exceeded",
        510 => "Not Extended",
        511 => "Network Authentication Required",
        598 => "Network read timeout error",
        599 => "Network connect timeout error");

    /**
     * @var Directory array, set by Request::getDirArray()
     */
    private static $dirArray = null;

    /**
     * @param string $name Index name in $_REQUEST array
     * @param string $format C-syntax format identifier
     * @param null $defaultValue Default return value
     * @return null|string Formatted value
     */
    public static function getVariable($name, $format = "%s", $defaultValue = null) {
        if (!isset($_REQUEST[$name]))
            return $defaultValue;
        return sprintf($format, $_REQUEST[$name]);
    }

    /**
     * Get the array of request URI directories
     * @return array Array of directories
     */
    public static function getDirArray() {
        if (!isset(self::$dirArray)) {
            self::$dirArray = explode("/", strtok($_SERVER["REQUEST_URI"], "?"));
        }
        return self::$dirArray;
    }

    /**
     * @param int $index Index of request URI direcroty
     * @return mixed
     * @throws \OutOfBoundsException
     */
    public static function getDir($index = 0) {
        if ($index > count(self::getDirArray()) || $index < 0) {
            throw new \OutOfBoundsException("Array index out of bounds");
        }
        return self::$dirArray[$index];
    }



} 