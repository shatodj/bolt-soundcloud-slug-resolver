<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud\Dto;

use stdClass;

class SoundcloudAlbum {

    
    /** @var string */
    public $slug;

    /** @var string */
    public $test = 'test';

    /**
     * @return SoundcloudAlbum
     */
    public static function create(stdClass $object) {
        $result = new SoundcloudAlbum();

        $result->test = (string) $object->test;
        $result->slug = (string) $object->slug;

        return $result;
    }
}