<?php

namespace FreshPHP\Helpers\BitwiseFlags;

/**
 * Class BitwiseFlag
 * @package FreshPHP\Helpers\BitwiseFlags
 * @author Stichoza <me@stichoza.com>
 * @author Wbcarts <wbcarts@juno.com>
 */
abstract class BitwiseFlag {

    protected $flags;

    protected function isFlagSet($flag) {
        return (($this->flags & $flag) == $flag);
    }

    protected function setFlag($flag, $value) {
        if($value) {
            $this->flags |= $flag;
        } else {
            $this->flags &= ~$flag;
        }
    }

} 