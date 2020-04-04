<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud\Provider;

use Bolt\Extension\SHatoDJ\Soundcloud\Service\SoundcloudService;
use Silex\Application;
use Silex\ServiceProviderInterface;

class SoundcloudServiceProvider implements ServiceProviderInterface
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function register(Application $app)
    {
        $app['soundcloud.api'] = $app->share(
            function ($app) {
                return new SoundcloudService($this->config);
            }
        );
    }

    public function boot(Application $app)
    {
    }
}
