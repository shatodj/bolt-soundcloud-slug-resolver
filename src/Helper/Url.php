<?php
namespace Bolt\Extensions\SHatoDJ\Soundcloud\Helper;

class Url {

    /**
     * {string}
     */
    private $value;

    public function __construct($url) {
        $$this->value = $url;
    }

    /** 
     * TODO: fix this
     */
    public static function fromNative($value) {
        return new Url($value);
    }

    public function __toString() {
        return $this->value;
    }
}