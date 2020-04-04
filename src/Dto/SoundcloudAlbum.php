<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud\Dto;

use stdClass;

class SoundcloudAlbum {

    
    /** @var string */
    public $slug;

    /** @var string */
    public $test = 'test';

    /** @var string */
    public $client_id;

    /**
     * @return SoundcloudAlbum
     */
    public static function create(stdClass $object) {
        $result = new SoundcloudAlbum();

        $result->test = (string) $object->test;
        $result->slug = (string) $object->slug;
        $result->client_id = (string) $object->client_id;

        return $result;
    }
}