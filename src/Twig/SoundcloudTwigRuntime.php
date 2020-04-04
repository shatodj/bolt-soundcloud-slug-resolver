<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud\Twig;

use Bolt\Extension\SHatoDJ\Soundcloud\Service\ISoundcloudService;

class SoundcloudTwigRuntime
{
    
    /** @var ISoundcloudService */
    private $service;


    public function __construct(ISoundcloudService $service)
    {
        $this->service = $service;
    }

    /**
     * @param string
     * 
     * @return mixed
     */
    public function resolve($slug) {
        try {
            return ['error' => null, 'data' => $this->service->resolve($slug)];
        } catch (\Throwable $th) {
            return ['error' => $th, 'data' => null];
        }
    }
}
