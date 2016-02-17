
WordPress YouTube Channel Plugin
==============

An YouTube channel and playlist plugin designed to pull content directly from the YouTube version 3 API. Plug-n-play with easy shortcodes for embeding a channel or playlist gallery. Designed from the need to have a SEO friendly, super simple YouTube channel and gallery with a dedicated watch video page that functions directly from shortcodes.

Need Support? Drop me a line at daniel.boorn@gmail.com

### Plugin Features
---
- Integrates against YouTube V3 API
- Channel gallery that is paged, responsive and searchable
- Playlist gallery that is paged, responsive and searchable
- Watch video page that is responsive with share features.
- Plug-n-play embed codes for each embeding
- Content pulled direct from YouTube API (no manual video entry)
- Supports multiple channels and playlists.
- MVC plugin design for easy extending/modification.
- MIT Licensed

### Getting Started
---

> Requires YouTube API version 3 server key. You can obtain a key free of charge from the Google Developers Console.

> Requires knowledge of how to use shortcodes in WordPress.

> Installation -- Download plugin zip file > WP Admin > Plugins > Add New > Upload > Activate > Embed Shortcode

### Short Codes
---
 > Shortcode for Gallery Page for YouTube Channel
 ```
 [dbyoutubechannelplugin_channel_index  videopageurl="watch-video-page" columns="1|2|3" limit="10" key="youtube-api-server-key" channel="youtube-channel-id"]
 ```

 > Shortcode for Gallery Page for YouTube Playlist (Must be in watch video channel)
 ```
 [dbyoutubechannelplugin_playlist_index videopageurl="watch-video-page" columns="1|2|3" limit="10" key="youtube-api-server-key" playlist="youtube-channel-playlist-id"]
 ```

 > Shortcode for Watch Page for YouTube Video (matches channel)
 ```
 [dbyoutubechannelplugin_watch_video key="youtube-api-server-key" channel="youtube-channel-id"]
 ```

### Plugin Development
---
This plugin uses a Object Oriented Model View Controller design. Knowledge of OO PHP is required for modification. This plugin is designed for modern PHP 5.3+. However, it may function on older versions. We have no intention of supporting older (less secure) versions of PHP.

DB YouTube Channel Plugin MVC Layout:
```
     - /assets/* (public css, fonts, js and install SQL, currently no SQL is required)
     - /views/admin/* (administration template files used by controllers)
     - /views/* (front end template files used by controllers)
     - /classes/controllers/* (front controllers)
     - /classes/controllers/admin/* (admin controllers)
     - /classes/models/* (database table models)
     - /classes/tables/* (admin panel table classes)
     - /classes/input.php (handles all input sanitizing for plugin)
     - /classes/model.php (base model class, extended by plugin models)
     - /classes/router.php (handles application MVC routing)
     - /classes/table.php (base table class, extended by plugin tables)
```

Need Support? Drop me a line at daniel.boorn@gmail.com
