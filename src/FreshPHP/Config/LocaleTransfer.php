<?php

namespace FreshPHP\Config;


class LocaleTransfer {

    /**
     * @var LocaleStringHandler
     */
    private static $lsh = null;

    /**
     * Set locale
     * @param $locale
     * @throws \Exception
     * @return bool
     */
    public static function setLocale($locale) {
        try {
            self::$lsh = new LocaleStringHandler($locale);
        } catch (\Exception $e) {
            throw $e;
        }
        return true;
    }

    /**
     * Get locale string from JSON file
     * @return string
     */
    public static function get(/* args... */) {
        if (self::$lsh instanceof LocaleStringHandler) {
            try {
                $string = self::$lsh->getString(func_get_args());
            } catch (\Exception $e) {
                $string = "";
            }
        } else {
            $string = "";
        }
        return $string;
    }

} 