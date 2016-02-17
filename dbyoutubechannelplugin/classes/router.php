<?php

class YoutubeChannelPlugin_Router
{
    public static $shortcodePrefix = "dbyoutubechannelplugin_";
    public static $defaultRoute = 'index-series';
    public static $controllers = array(
        // add additional controllers here
    );

    public static function throw404()
    {
        global $wp_query;
        $wp_query->set_404();
        require TEMPLATEPATH . '/404.php';
        exit;
    }

    public static function getUri()
    {
        return $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
    }

    public static function redirect($url)
    {
        @wp_redirect($url);
        // word around for WP sending out header info.
        echo "<meta http-equiv='refresh' content='0; url={$url}'>";
        exit();
    }

    public static function redirectPath($path, $queryStr = null)
    {
        static::redirect($_SERVER['PHP_SELF'] . '?page=' . $path . $queryStr);
    }

    public static function loadView($viewPath, $params = array())
    {
        // additional sanitizing can be performed here
        foreach ($params as $key => $value) {
            ${$key} = $value;
        }
        ob_start();
        require YOUTUBECHANNELPLUGIN_DIR . "views/{$viewPath}.php";
        $html = ob_get_clean();
        return $html;
    }

    public static function channelIndex($attributes, $html = null)
    {
        $attributes = shortcode_atts(array(
            'videopageurl' => null,
            'columns'      => '3',
            'limit'        => '100',
            'key'          => null,
            'channel'      => null,
        ), $attributes, 'channel_index');

        YoutubeChannelPlugin_Controllers_Channel::actionIndex($attributes);
    }

    public static function playlistIndex($attributes, $html = null)
    {
        $attributes = shortcode_atts(array(
            'videopageurl' => null,
            'columns'      => '3',
            'limit'        => '100',
            'key'          => null,
            'playlist'      => null,
        ), $attributes, 'playlist_index');

        YoutubeChannelPlugin_Controllers_Channel::actionPlaylist($attributes);
    }


    public static function sermonTitle($title)
    {
        global $wp_query;
        $post = $wp_query->get_queried_object();
        if (!$post || $title != $post->post_title) {
            return $title;
        }

        if (YoutubeChannelPlugin_Input::param('sermon') && ($sermon = YoutubeChannelPlugin_Model_Sermons::find(YoutubeChannelPlugin_Input::param('sermon')))) {
            return $sermon->title;
        }
        if (YoutubeChannelPlugin_Input::param('series') && ($series = YoutubeChannelPlugin_Model_Series::find(YoutubeChannelPlugin_Input::param('series')))) {
            list($count, $rows) = YoutubeChannelPlugin_Model_Sermons::search(array('series_id' => $series->id), 1, 0, 'sermon_date', 'desc');
            if ($count) {
                $sermon = current($rows);
                return $sermon->title;
            }
        }
        return $title;
    }

    public static function watchVideo($attributes, $html = null)
    {
        $attributes = shortcode_atts(array(
            'key'          => null,
            'channel'      => null,
        ), $attributes, 'watch_video');
        YoutubeChannelPlugin_Controllers_Channel::actionWatchVideo($attributes);
    }


    public static function install()
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();
        $sql = file_get_contents(YOUTUBECHANNELPLUGIN_DIR . 'assets/install.sql');
        $sql = str_replace("{wp_prefix}", $wpdb->prefix, $sql);
        $sql = str_replace("{charset}", $charsetCollate, $sql);

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        update_option("youtubechannelplugin_db_version", YOUTUBECHANNELPLUGIN_VERSION);

        foreach (explode(";", $sql) as $query) {
            dbDelta($query);
        }
    }
    public static function registerShortCodes()
    {
        add_shortcode(static::$shortcodePrefix . "playlist_index", array('YoutubeChannelPlugin_Router', 'playlistIndex'));
        add_shortcode(static::$shortcodePrefix . "channel_index", array('YoutubeChannelPlugin_Router', 'channelIndex'));
        add_shortcode(static::$shortcodePrefix . "watch_video", array('YoutubeChannelPlugin_Router', 'watchVideo'));
    }

}

