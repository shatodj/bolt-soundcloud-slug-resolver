<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf9d5e70696d38685930c9ce75933f404
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
        'N' => 
        array (
            'Njasm\\' => 6,
        ),
        'I' => 
        array (
            'Interop\\Container\\' => 18,
        ),
        'B' => 
        array (
            'Bolt\\Tests\\' => 11,
            'Bolt\\Extension\\SHatoDJ\\Soundcloud\\Tests\\' => 40,
            'Bolt\\Extension\\SHatoDJ\\Soundcloud\\' => 34,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Njasm\\' => 
        array (
            0 => __DIR__ . '/..' . '/njasm/container/src',
            1 => __DIR__ . '/..' . '/njasm/soundcloud/src',
        ),
        'Interop\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/container-interop/container-interop/src/Interop/Container',
        ),
        'Bolt\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/bolt/bolt/tests/phpunit/unit',
        ),
        'Bolt\\Extension\\SHatoDJ\\Soundcloud\\Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
        'Bolt\\Extension\\SHatoDJ\\Soundcloud\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf9d5e70696d38685930c9ce75933f404::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf9d5e70696d38685930c9ce75933f404::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
