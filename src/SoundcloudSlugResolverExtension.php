<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud;

$autoload = __DIR__ . '/../vendor/autoload.php';
if (is_file($autoload)) {
    require $autoload;
}

use Bolt\Extension\SHatoDJ\Soundcloud\Provider\SoundcloudServiceprovider;
use Bolt\Extension\SimpleExtension;
use Silex\Application;

/**
 * SoundcloudSlugResolver extension class.
 *
 * @author Jakub Šatník <kubo1988@gmail.com>
 */
class SoundcloudSlugResolverExtension extends SimpleExtension
{
   
     /**
     * {@inheritdoc}
     */
    public function getServiceProviders()
    {
        return [
            $this,
            new SoundcloudServiceProvider($this->getConfig())
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultConfig()
    {
        return [
            'client_id' => "",
            'base_url' => "api.soundcloud.com"
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function registerServices(Application $app)
    {
        $app['soundcloud.config'] = $app->share(
            function () {
                return $this->getConfig();
            }
        );

        // Create a runtime for the Twig extension class
        $app['twig.runtime.soundcloud'] = $app->share(function ($app) {
            // Our runtime uses the $app['koala.gumtree'] service, so we
            // want to "lazy load" it as needed.
            return new Twig\SoundcloudTwigRuntime($app['soundcloud.service']);
        });

        $app['twig.runtimes'] = $app->extend(
            'twig.runtimes',
            function (array $runtimes) {
                // You must append your array to the passed in $runtimes array and return it
                return $runtimes + [
                    Twig\SoundcloudTwigRuntime::class => 'twig.runtime.soundcloud',
                ];
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function registerTwigFunctions()
    {
        return [
            'soundcloud_resolve' => [[Twig\SoundcloudTwigRuntime::class, 'resolve']],
        ];
    }
}