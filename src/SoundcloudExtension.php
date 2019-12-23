<?php

namespace Bolt\Extension\SHatoDJ\Soundcloud;

use Bolt\Extension\SimpleExtension;
use Bolt\Extensions\SHatoDJ\Soundcloud\Provider\SoundcloudFieldProvider;

/**
 * ExtensionName extension class.
 *
 * @author Your Name <you@example.com>
 */
class SoundcloudExtension extends SimpleExtension
{
    public function getServiceProviders()
    {
        return [
            $this,
            new SoundcloudFieldProvider()
        ];
    }
    protected function registerTwigPaths()
    {
        return [
            'templates/bolt' => ['position' => 'prepend', 'namespace'=>'bolt']
        ];
    }
}