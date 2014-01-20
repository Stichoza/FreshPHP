<?php

namespace FreshPHP\Helpers\BitwiseFlags;

/**
 * Class StaticBitwiseFlags
 * @package FreshPHP\Helpers\BitwiseFlags
 * @author Stichoza <me@stichoza.com>
 */
class StaticBitwiseFlags {

    public static function isFlagSet($number, $flag) {
        return (($number & $flag) == $flag);
    }

} 