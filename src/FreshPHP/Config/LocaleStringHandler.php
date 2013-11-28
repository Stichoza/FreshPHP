<?php

namespace FreshPHP\Config;

use FreshPHP\Singleton\Singleton;

/**
 * Class LocaleStringHandler
 * @package FreshPHP\Config
 * @author Stichoza <me@stichoza.com>
 */
class LocaleStringHandler extends Singleton {

    /**
     * Locale files directory with trailing slash
     */
    const LOCALE_DIRECTORY = "config/locale/";

    /**
     * @var array $localeData Array containing language strings
     */
    private $localeData = array();

    /**
     * @param string $locale Locale id (filename without extension)
     * @throws \Exception
     */
    public function __construct($locale) {
        $filename = self::LOCALE_DIRECTORY . $locale . ".json";
        if (!$fileSource = file_get_contents($filename)) {
            throw new \Exception("Error reading locale file");
        } elseif (!$this->localeData = json_decode($fileSource, true)) {
            throw new \Exception("Invalid JSON");
        }
    }

} 