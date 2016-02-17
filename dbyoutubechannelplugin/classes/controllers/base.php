<?php


class YoutubeChannelPlugin_Controller_Base
{
    public static function getHeader($path = '_header')
    {
        return static::loadView($path);
    }

    public static function loadView($path, $params = array())
    {
        return YoutubeChannelPlugin_Router::loadView($path, $params);
    }

}