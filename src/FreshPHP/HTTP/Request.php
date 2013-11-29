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
     * @var array Directory array, set by Request::getDirArray()
     */
    private static $dirArray = null;

    /**
     * @param array $array
     * @param $key
     * @param string $format
     * @param null $defaultValue
     * @return null|string
     */
    private static function getValueFromArray(array $array, $key, $format = "%s", $defaultValue = null) {
        if (!isset($array[$key]))
            return $defaultValue;
        return sprintf($format, $array[$key]);
    }

    /**
     * @param string $key Index name in $_REQUEST array
     * @param string $format C-syntax format identifier
     * @param null $defaultValue Default return value
     * @return null|string Formatted value
     */
    public static function getVariable($key, $format = "%s", $defaultValue = null) {
        return self::getValueFromArray($_REQUEST, $key, $format, $defaultValue);
    }

    /**
     * @param string $key Index name in $_GET array
     * @param string $format C-syntax format identifier
     * @param null $defaultValue Default return value
     * @return null|string Formatted value
     */
    public static function getGetVar($key, $format = "%s", $defaultValue = null) {
        return self::getValueFromArray($_GET, $key, $format, $defaultValue);
    }

    /**
     * @param string $key Index name in $_POST array
     * @param string $format C-syntax format identifier
     * @param null $defaultValue Default return value
     * @return null|string Formatted value
     */
    public static function getPostVar($key, $format = "%s", $defaultValue = null) {
        return self::getValueFromArray($_POST, $key, $format, $defaultValue);
    }

    /**
     * @param string $key Index name in $_SESSION array
     * @param string $format C-syntax format identifier
     * @param null $defaultValue Default return value
     * @return null|string Formatted value
     */
    public static function getSessionVar($key, $format = "%s", $defaultValue = null) {
        return self::getValueFromArray($_SESSION, $key, $format, $defaultValue);
    }

    /**
     * @param string $key Index key in $_SESSION array
     * @param string $value Value of session variable
     * @return boolean True is set successfully
     */
    public static function setSessionVar($key, $value) {
        if (is_array($_SESSION)) {
            $_SESSION[$key] = $value;
            return true;
        }
        return false;
    }

    /**
     * @param string $key Index name in $_COOKIE array
     * @param string $format C-syntax format identifier
     * @param null $defaultValue Default return value
     * @return null|string Formatted value
     */
    public static function getCookie($key, $format = "%s", $defaultValue = null) {
        return self::getValueFromArray($_COOKIE, $key, $format, $defaultValue);
    }

    /**
     *
     */
    public static function setCookie() {
        // TODO implement setCookie()
    }

    /**
     * Get test message of HTTP error code
     * @param int $errorCode HTTP Error Code
     * @return string Error status string
     */
    public static function getErrorMessage($errorCode) {
        return (isset(self::$HTTPErrorCodes[$errorCode])) ? self::$HTTPErrorCodes[$errorCode] :
            "Unknown Error";
    }

    /**
     * Get the array of request URI directories
     * @return array Array of directories
     * @throws \Exception
     */
    public static function getDirArray() {
        if (!isset(self::$dirArray)) {
            if (!isset($_SERVER["REQUEST_URI"]))
                throw new \Exception("Server variable REQUEST_URI not set");
            self::$dirArray = explode("/", trim(strtok($_SERVER["REQUEST_URI"], "?"), "/"));
        }
        return self::$dirArray;
    }

    /**
     * @param int $index Index of request URI direcroty
     * @param boolean $exceptions Throw exceptions
     * @return string
     * @throws \OutOfBoundsException
     */
    public static function getDir($index = 0, $exceptions = false) {
        if ($index > count(self::getDirArray()) || $index < 0) {
            if ($exceptions)
                throw new \OutOfBoundsException("Array index out of bounds");
            return "";
        }
        return self::$dirArray[$index];
    }

    /**
     * Send HTTP error header
     * @param int $code HTTP Error code
     */
    public static function setErrorCode($code = 404) {
        ob_clean();
        if (function_exists('http_response_code')) {
            http_response_code($code);
        } else {
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] :
                'HTTP/1.0');
            header($protocol . ' ' . $code . ' ' . self::getErrorMessage($code));
        }
    }

    /**
     * Redirect user to an URL
     * @param $url
     */
    public static function redirect($url) {
        ob_clean();
        header("location: " . $url);
        exit();
    }

} 