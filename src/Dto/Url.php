<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud\Dto;

class Url {

    /**
     * {string}
     */
    private $value = '';

    public function __construct($url) {
        $this->value = $url;
    }

    
    public static function fromNative($value) {
        return new Url($value);
    }

    public function __toString() {
        return empty($this->value) ? '' : (string)$this->value ;
    }
}