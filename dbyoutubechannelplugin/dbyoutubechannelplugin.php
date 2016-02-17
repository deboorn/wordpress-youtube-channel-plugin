<?php

/*
Plugin Name: DB YouTube Channel
Plugin URI:
Description: Add responsive youtube channel video to your website.
Author: Rapid Digital LLC, Daniel Boorn <daniel.boorn@gmail.com>
Version: 1.0.0
Author URI: http://rapiddigitalllc.com
*/

/**
 * MVC Design    - This plugin uses a Object Oriented Model View Controller design. Knowledge of OO PHP is required for modification.
 * PHP 5.3+      - This plugin is designed for modern PHP 5.3+. However, it may function on older versions.
 *               - We have no intention of supporting older (less secure) versions of PHP.
 * Questions?    - Got a question or need a modification? Drop us a line at daniel.boorn@gmail.com
 * Shortcodes    -
 *
 * Shortcode for Gallery Page for YouTube Channel
 * [dbyoutubechannelplugin_channel_index videopageurl="watch-video-page" columns="1|2|3" limit="10" key="youtube-api-server-key" channel="youtube-channel-id"]
 *
 * Shortcode for Gallery Page for YouTube Playlist (Must be in watch video channel)
 * [dbyoutubechannelplugin_playlist_index videopageurl="watch-video-page" columns="1|2|3" limit="10" key="youtube-api-server-key" playlist="youtube-channel-playlist-id"]
 *
 * Shortcode for Watch Page for YouTube Video (matches channel)
 * [dbyoutubechannelplugin_watch_video key="youtube-api-server-key" channel="youtube-channel-id"]
 *
 */

/**
 * DB YouTube Channel Plugin MVC Layout:
 *     - /assets/* (public css, fonts, js and install SQL)
 *     - /views/admin/* (administration template files used by controllers)
 *     - /views/* (front end template files used by controllers)
 *     - /classes/controllers/* (front controllers)
 *     - /classes/controllers/admin/* (admin controllers)
 *     - /classes/models/* (database table models)
 *     - /classes/tables/* (admin panel table classes)
 *     - /classes/input.php (handles all input sanitizing for plugin)
 *     - /classes/model.php (base model class, extended by plugin models)
 *     - /classes/router.php (handles application MVC routing)
 *     - /classes/table.php (base table class, extended by plugin tables)
 */

if (!function_exists('add_action')) exit();

define('YOUTUBECHANNELPLUGIN_URL', WP_PLUGIN_URL . '/dbyoutubechannelplugin/');
define('YOUTUBECHANNELPLUGIN_DIR', plugin_dir_path(__FILE__));
define('YOUTUBECHANNELPLUGIN_VERSION', '1.0.0');

// Bootstrap YouTube Channel Plugin
require_once YOUTUBECHANNELPLUGIN_DIR . "/classes/input.php";
require_once YOUTUBECHANNELPLUGIN_DIR . "/classes/model.php";
require_once(YOUTUBECHANNELPLUGIN_DIR . "classes/models/channel.php");
// model classes here ...
require_once YOUTUBECHANNELPLUGIN_DIR . "/classes/table.php";
// table classes here ...
require_once YOUTUBECHANNELPLUGIN_DIR . "/classes/router.php";
require_once YOUTUBECHANNELPLUGIN_DIR . "/classes/controllers/base.php";


if (is_admin()) {
    require_once YOUTUBECHANNELPLUGIN_DIR . "/classes/controllers/admin.php";
    // admin controllers here ...
    // not in use
    //YoutubeChannelPlugin_Router::hookAdmin();
    register_activation_hook(__FILE__, array('YoutubeChannelPlugin_Router', 'install'));

} else {
    require_once YOUTUBECHANNELPLUGIN_DIR . "/classes/controllers/channel.php";
    // front end controllers here ...
    YoutubeChannelPlugin_Router::registerShortCodes();
}



