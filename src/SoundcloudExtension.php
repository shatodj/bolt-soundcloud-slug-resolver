<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud;

use Bolt\Extension\SHatoDJ\Soundcloud\Field\SoundcloudField;
use Bolt\Extension\SHatoDJ\Soundcloud\Provider\SoundcloudApiProvider;
use Bolt\Extension\SHatoDJ\Soundcloud\Provider\SoundcloudFieldProvider;
use Bolt\Extension\SHatoDJ\Soundcloud\Provider\SoundcloudServiceprovider;
use Bolt\Extension\SHatoDJ\Soundcloud\Twig\SoundcloudService;
use Bolt\Extension\SimpleExtension;
use Bolt\Storage\FieldManager;
use Silex\Application;

/**
 * ExtensionName extension class.
 *
 * @author Your Name <you@example.com>
 */
class SoundcloudExtension extends SimpleExtension
{
   
    public function registerFields()
    {
        return [
            new SoundcloudField(),
        ];
    }

    public function getServiceProviders()
    {
        return [
            $this,
            new SoundcloudServiceProvider($this->getConfig()),
            new SoundcloudFieldProvider(),
        ];
    }

    // protected function registerServices(Application $app)
    // {
    //     // Create a runtime for the Twig extension class
    //     $app['twig.runtime.soundcloud'] = $app->share(function ($app) {
    //         // Our runtime uses the $app['koala.gumtree'] service, so we
    //         // want to "lazy load" it as needed.
    //         return new Twig\SoundcloudTwigRuntime($app['soundcloud.api']);
    //     });

    //     $app['twig.runtimes'] = $app->extend(
    //         'twig.runtimes',
    //         function (array $runtimes) {
    //             // You must append your array to the passed in $runtimes array and return it
    //             return $runtimes + [
    //                 Twig\SoundcloudTwigRuntime::class => 'twig.runtime.soundcloud',
    //             ];
    //         }
    //     );
    // }

    protected function registerTwigPaths()
    {
        return [
            'templates' => ['position' => 'prepend', 'namespace' => 'soundcloud'],
        ];
    }

    // protected function registerTwigFunctions()
    // {
    //     $scTwigRuntimeCallable = [Twig\SoundcloudTwigRuntime::class, 'hello'];

    //     return [
    //         'soundcloud_album' => [$scTwigRuntimeCallable]
    //     ];
    // }
}