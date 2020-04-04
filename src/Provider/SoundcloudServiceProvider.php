<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud\Provider;

use Bolt\Extension\SHatoDJ\Soundcloud\Service\SoundcloudApi;
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
            function () {
                $scApi = new SoundcloudApi($this->config['client_id']);
                $scApi->setBaseUrl($this->config['base_url']);

                return $scApi;
            }
        );

        $app['soundcloud.service'] = $app->share(
            function ($app) {
                return new SoundcloudService($app['soundcloud.api']);
            }
        );
    }

    public function boot(Application $app)
    {
    }
}
