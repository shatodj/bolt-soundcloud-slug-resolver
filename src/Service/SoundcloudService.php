<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud\Service;

use Bolt\Extension\SHatoDJ\Soundcloud\Dto\SoundcloudErrorDto;
use Bolt\Extension\SHatoDJ\Soundcloud\Dto\SoundcloudPlaylistDto;
use Exception;
use InvalidArgumentException;
use Njasm\Soundcloud\Request\Response;
use Njasm\Soundcloud\Request\ResponseInterface;

class SoundcloudService implements ISoundcloudService
{
   
    /** @var Soundcloud */
    private $soundcloudApi;

    public function __construct(SoundcloudApi $api)
    {
        $this->soundcloudApi = $api;
    }

    /**
     * @inheritdoc
     */
    public function resolve($slug)
    {
        $this->testSlug($slug);

        return $this->callResolve($slug);
    }

    private function testSlug($slug) {
        if (empty($slug)) {
            throw new InvalidArgumentException("Invalid format of soundcloud \$slug '$slug'.");
        }
    }

    /**
     * @return mixed
     */
    private function callResolve($slug) {
        /** @var Response */
        $response = $this->soundcloudApi->get('/resolve', ['url' => "https://soundcloud.com/$slug"])->asJson()->request();

        if (!empty($response->getErrorString())) {
            throw new Exception($response->getErrorString());
        }

        $object = $response->bodyObject();

        if (empty($object->kind)) {
            throw new Exception("Invalid \$slug '$slug'.");
        }

        return $object;
    }

}
