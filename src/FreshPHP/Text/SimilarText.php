<?php

namespace FreshPHP\Text;

/**
 * Class SimilarText
 * @package FreshPHP\Text
 * @author Stichoza <me@stichoza.com>
 */
class SimilarText {

    /**
     * @var array Base of texts/words
     */
    protected $base;

    /**
     * @param array $base Initial text(s) or word(s) to add to text base
     * @throws \InvalidArgumentException
     */
    public function __construct($base = array()) {
        if (!is_array($base)) {
            throw new \InvalidArgumentException("Not an array");
        }
        $this->addToBase($base);
    }

    /**
     * Add text(s) or word(s) to the base
     * @param $add string|array Text(s) or word(s) to add to text base
     * @return SimilarText Self instance
     */
    public function addToBase($add) {
        if (is_array($add)) {
            foreach ($add as $key => $value) {
                if (!is_array($value) && !in_array($value, $this->base)) {
                    $this->base[] = $value;
                }
            }
        } else {
            $this->base[] = $add;
        }
        return $this;
    }

    /**
     * Get similar text(s)/word(s)
     * @param $string
     * @param int $limit
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getSimilar($string, $limit = 0) {

        // Indexed array of results
        $indexedResults = array();

        // Final results
        $finalResults = array();

        // Check arguments
        if (!is_int($limit)) {
            throw new \InvalidArgumentException("Limit must be integer type");
        } elseif ($limit < 0) {
            throw new \InvalidArgumentException("Limit must not me less than 0");
        }

        // Create associative array of similarities
        for ($i = 0; $i < count($this->base); $i++) {
            $indexedResults[$this->base[$i]] = levenshtein($string, $this->base[$i]);
        }

        // Sort (more similar first)
        asort($indexedResults);

        for ($i = 0; $i < count($indexedResults); $i++) {
            if ($limit > 0 && $i > $limit) {
                break;
            }
            $finalResults[] = $indexedResults[$i];
        }

        return $finalResults;

    }

}