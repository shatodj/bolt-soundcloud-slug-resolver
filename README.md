# BOLT CMS Soundloud Slug Resolver Extension.

The extension provides Twig Template Runtime function that will resolve Soundcloud Slug and inject data to twig template.

## Usage

```twig
<div>
    {% set sc_resolved = soundcloud_resolve(section.soundcloudslug) %}
    {% if sc_resolved.error is not null %}
        {{ sc_resolved.error.message }}
    {% else %}
        Soundcloud Title {{ sc_resolved.data.title }}
    {% endif %}
</div>
```

Feel free to experiment with other standard soundclouds slugs. For more info check [Soundcloud HTTP API]("https://developers.soundcloud.com/docs/api/guide") and [/resolve]("https://developers.soundcloud.com/docs/api/reference#resolve") resouce.

# Configuration

Be sure to set proper settings to the extension.

```yml
# Soundcloud BASE URL. Change this when the default URL is not working with provided `client_id`.
# eg.: https://api-mobi.soundcloud.com
base_url: https://api.soundcloud.com

# In case you do not own your developer Client ID, try to extract one
# from browser console (F12) when refreshing Soundcloud page or playback track.
client_id: <CLIENT_ID>
```

## Installation

TBD.

