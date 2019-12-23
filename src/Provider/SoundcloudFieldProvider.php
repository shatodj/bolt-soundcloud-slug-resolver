<?php

namespace Bolt\Extensions\SHatoDJ\Soundcloud\Provider;

use Bolt\Extension\Ross\URLField\Field\URLFieldType;
use Bolt\Extensions\SHatoDJ\Soundcloud\Field\SoundcloudField;
use Bolt\Storage\FieldManager;
use Silex\Application;
use Silex\ServiceProviderInterface;

class SoundcloudFieldProvider implements ServiceProviderInterface {

    public function register(Application $app)
    {
        $app['storage.typemap'] = array_merge(
            $app['storage.typemap'],
            [
                'soundcloud' => SoundcloudField::class
            ]
        );

        $app['storage.field_manager'] = $app->share(
            $app->extend(
                'storage.field_manager',
                function (FieldManager $manager) {
                    $manager->addFieldType('url', new SoundcloudField());

                    return $manager;
                }
            )
        );

    }

    public function boot(Application $app)
    {
    }
}