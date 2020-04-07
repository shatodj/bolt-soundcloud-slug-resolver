<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud\Service;

use Exception;
use InvalidArgumentException;
use Njasm\Soundcloud\Request\Response;

class SoundcloudService implements ISoundcloudService
{
   
    /** @var SoundcloudApi|null */
    private $soundcloudApi;

    public function __construct(SoundcloudApi $api = null)
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
        if (empty($this->soundcloudApi)) {
            throw new Exception("Soundcloud API was not initialized properly. Check CLIENT_ID property in extension configuration.");   
        }

        /** @var Response */
        $response = $this->soundcloudApi->get('/resolve', ['url' => "https://soundcloud.com/$slug"])
            ->request([CURLOPT_FOLLOWLOCATION => true]);

        if (!empty($response->getErrorString())) {
            throw new Exception($response->getErrorString());
        }

        if (!empty($response->getHttpCode() !== 200)) {
            throw new Exception("Soundcloud API Error: {$response->getHttpCode()}: {$response->getHttpCodeString()}", $response->getHttpCode());
        }

        $object = $response->bodyObject();

        if (empty($object->kind)) {
            throw new Exception("Invalid \$slug '$slug'.");
        }

        return $object;
    }

}
