<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud\Service;

interface ISoundcloudService {

    /**
     * @param string
     * 
     * @return mixed
     */
    public function resolve($slug);
}