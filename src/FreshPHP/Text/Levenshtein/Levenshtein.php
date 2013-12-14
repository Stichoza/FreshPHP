<?php

namespace FreshPHP\Text\Levenshtein;

/**
 * Class Levenshtein
 * @package FreshPHP\Text\Levenshtein
 * @author Stichoza <me@stichoza.com>
 */
class Levenshtein {

    /**
     * Limit of strings to compare
     */
    const STRING_LENGTH_LIMIT = 255;

    /**
     * @var String one
     */
    protected $string1;

    /**
     * @var String two
     */
    protected $string2;

    /**
     * The cost of insertion.
     * @var int
     */
    protected $costIns = 1;

    /**
     * The cost of replacement.
     * @var int
     */
    protected $costRep = 1;

    /**
     * The cost of deletion.
     * @var int
     */
    protected $costDel = 1;

    /**
     * @param mixed $string2
     * @throws LevenshteinException
     * @return Levenshtein self instance
     */
    public function setString2($string2)
    {
        if (strlen($string2) > self::STRING_LENGTH_LIMIT) {
            throw new LevenshteinException("String");
        }
        $this->string2 = $string2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getString2()
    {
        return $this->string2;
    }

    /**
     * @param mixed $string1
     * @throws LevenshteinException
     * @return Levenshtein self instance
     */
    public function setString1($string1)
    {
        if (strlen($string1) > self::STRING_LENGTH_LIMIT) {
            throw new LevenshteinException("String");
        }
        $this->string1 = $string1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getString1()
    {
        return $this->string1;
    }

    /**
     * Defines the cost of deletion.
     * @param int $costDel The cost of deletion.
     * @return Levenshtein self instance
     */
    public function setCostDel($costDel)
    {
        $this->costDel = $costDel;
        return $this;
    }

    /**
     * Returns the cost of insertion.
     * @return int The cost of insertion.
     */
    public function getCostDel()
    {
        return $this->costDel;
    }

    /**
     * Defines the cost of insertion.
     * @param int $costIns The cost of insertion.
     * @return Levenshtein self instance
     */
    public function setCostIns($costIns)
    {
        $this->costIns = $costIns;
        return $this;
    }

    /**
     * Returns the cost of insertion.
     * @return int The cost of insertion.
     */
    public function getCostIns()
    {
        return $this->costIns;
    }

    /**
     * Defines the cost of replacement.
     * @param int $costRep The cost of replacement.
     * @return Levenshtein self instance
     */
    public function setCostRep($costRep)
    {
        $this->costRep = $costRep;
        return $this;
    }

    /**
     * Returns the cost of replacement.
     * @return int The cost of replacement.
     */
    public function getCostRep()
    {
        return $this->costRep;
    }

    /**
     * @param boolean $exceptions Throw exceptions
     * @throws LevenshteinException
     * @return int The Levenshtein-Distance between the two strings
     */
    public function getDistance($exceptions = false) {
        $distance = levenshtein(
            $this->getString1(),
            $this->getString2(),
            $this->getCostIns(),
            $this->getCostRep(),
            $this->getCostDel()
        );
        if ($distance < 0 && $exceptions) {
            throw new LevenshteinException("Levenstein function failed");
        }
        return $distance;
    }

} 