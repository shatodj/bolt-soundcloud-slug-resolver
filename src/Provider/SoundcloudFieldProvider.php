<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud\Provider;

use Bolt\Extension\SHatoDJ\Soundcloud\Field\SoundcloudField;
use Bolt\Storage\FieldManager;
use Silex\Application;
use Silex\ServiceProviderInterface;

class SoundcloudFieldProvider implements ServiceProviderInterface {

    
    public function register(Application $app)
    {
        $app['storage.typemap'] = array_merge(
            $app['storage.typemap'],
            [
                'soundcloud.field' => SoundcloudField::class
            ]
        );

        $app['storage.field_manager'] = $app->share(
            $app->extend(
                'storage.field_manager',
                function (FieldManager $manager) {
                    $manager->addFieldType('soundcloud.field', new SoundcloudField());

                    return $manager;
                }
            )
        );
    }

    public function boot(Application $app)
    {
    }
}