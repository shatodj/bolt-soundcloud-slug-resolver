<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud\Service;

use Bolt\Extension\SHatoDJ\Soundcloud\Dto\SoundcloudAlbum;

class SoundcloudService
{
    private $config;

    public function __constructor(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return SoundcloudAlbum
     */
    public function getAlbum($slug) {
        
        return SoundcloudAlbum::create((object) [
            'test' => 'test hello',
            'slug' => (string) $slug,
            'client_id' => (string) $this->config['client_id']
        ]);
    }

}
