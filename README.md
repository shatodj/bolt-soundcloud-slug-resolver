# BOLT CMS Soundcloud Slug Resolver Extension.

The extension provides Twig Template Runtime function that will resolve Soundcloud Slug and inject data to the TWIG template.

```twig
{% set sc_resolved = soundcloud_resolve('shatopaulrockseek/sets/singles') %}
Soundcloud Title {{ sc_resolved.data.title }}
```

## Disclaimer

Before you jump into using this extension on some of your awesome projects, mind that you have to register your [Soundcloud App]("https://soundcloud.com/you/apps") first to obtain client credentials. However, **Soundcloud stopped providing new app registrations** due to a high amount of requests and no one knows when they'll be back again with some other innovative way.

You can still browse Google for some existing credentials or try to extract `CLIENT_ID` from the Soundcloud website and browser console (F12) traffic view.

## Installation

1. From Bolt Market Place

    - Find `shatodj/bolt-soundcloud-slug-resolver` in Bolt extensions sections

1. Using composer

    - Go to Bolt project `/extensions` folder and run

    ```bash
    composer require shatodj/bolt-soundcloud-slug-resolver
    ```

1. Brute force (if market doesn't work) :)

    - Add new `bolt-soundcloud-slug-resolver` repository entry to `/extensions/composer.json` like this eg.:
    
    ```json
     "repositories": {
        "packagist": false,
        "bolt": {
            "type": "composer",
            "url": "https://market.bolt.cm/satis/"
        },
        "bolt-soundcloud-slug-resolver": {
            "type": "git",
            "url": "https://github.com/shatodj/bolt-soundcloud-slug-resolver"
        }
    },

    ```

    - Change `minimum-stability` to `dev` in `extensions/package.json`
    
    ```json
    "minimum-stability": "dev",
    ```

    - Add new require entry to `extensions/package.json` eg.:
    
    ```json
    require: {
        // ..
        "shatodj/bolt-soundcloud-slug-resolver": "dev-master@dev"
    }

    ```

## Usage

Use the new twig function `soundcloud_resolve('/your_dj_slug/your_track')` to get data from Soundcloud.

```twig
<div>
    {% set sc_resolved = soundcloud_resolve('shatopaulrockseek/sets/singles') %}
    {% if sc_resolved.error is not null %}
        {{ sc_resolved.error.message }}
    {% else %}
        Soundcloud Title {{ sc_resolved.data.title }}
    {% endif %}
</div>
```

The function returns this data object:

```js
{
    // error object with info about errors (eg. 401, not autorized) \Throwable interface
    error: {
        message: "string"
        code: "string"
    },
    // an actual Soundcloud data, or null (if `error` prop. is not null)
    data: {} 
}
```

Feel free to experiment with other standard Soundcloud slugs. For more info check [Soundcloud HTTP API]("https://developers.soundcloud.com/docs/api/guide") and [/resolve]("https://developers.soundcloud.com/docs/api/reference#resolve") resource.

# Configuration

Be sure to set proper settings for the extension.

```yml
# Soundcloud BASE URL. Change this when the default URL is not working with the desired `CLIENT_ID`.
# eg.: https://api-mobi.soundcloud.com
base_url: https://api.soundcloud.com

# In case you do not own your developer Client ID, try to extract one
# from browser console (F12) when refreshing Soundcloud page or playback track.
client_id: <CLIENT_ID>
```

## Licence

MIT
