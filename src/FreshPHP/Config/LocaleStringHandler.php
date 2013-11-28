<?php

namespace FreshPHP\Config;

/**
 * Class LocaleStringHandler
 * @package FreshPHP\Config
 * @author Stichoza <me@stichoza.com>
 */
class LocaleStringHandler {

    /**
     * Locale files directory with trailing slash
     */
    const LOCALE_DIRECTORY = "config/locale/";

    /**
     * @var array $localeData Array containing language strings
     */
    private $localeData = array();

    /**
     * @var string Language code
     */
    private $langCode = null;

    /**
     * @param string $locale Locale id (filename without extension)
     * @throws \Exception
     */
    public function __construct($locale) {
        $locale = strtolower($locale);
        $filename = self::LOCALE_DIRECTORY . $locale . ".json";
        if (!$fileSource = file_get_contents($filename)) {
            throw new \Exception("Error reading locale file");
        } elseif (!$this->localeData = json_decode($fileSource, true)) {
            throw new \Exception("Invalid JSON");
        }
        $this->langCode = $locale;
    }

    /**
     * @param array $stringRoute
     * @throws \BadFunctionCallException
     * @throws \OutOfBoundsException
     * @return string
     */
    public function getString(array $stringRoute) {
        $param = $this->localeData;
        foreach ($stringRoute as $arg) {
            if (!isset($param[$arg]))
                throw new \OutOfBoundsException("Array key not found");
            $param = $param[$arg];
        }
        return $param;
    }

    /**
     * Get language code
     * @return string Language code
     */
    public function getLocale() {
        return $this->langCode;
    }

} 