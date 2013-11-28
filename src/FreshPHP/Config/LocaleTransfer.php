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
     * @return bool
     */
    public static function setLocale($locale) {
        try {
            self::$lsh = new LocaleTransfer($locale);
        } catch (\Exception $e) {
            $localeLoaded = true;
        }
        return !!$localeLoaded;
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