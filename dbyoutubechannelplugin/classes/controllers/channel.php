<?php

class YoutubeChannelPlugin_Controllers_Channel extends YoutubeChannelPlugin_Controller_Base
{
    /**
     *
     * @param $attributes
     * @param null $html
     */
    public static function actionWatchVideo($attributes, $html = null)
    {
        $result = YoutubeChannelPlugin_Model_Channel::getVideo(YoutubeChannelPlugin_Input::param('v'), $attributes['channel'], $attributes['key']);

        if (!count($result) || !count($result['items']) || $result['items'][0]['snippet']['channelId'] != $attributes['channel']) {
            YoutubeChannelPlugin_Router::throw404();
        }

        echo static::loadView('channel/watch', array(
            '_header'    => static::getHeader(),
            'html'       => $html,
            'result'     => $result,
            'attributes' => $attributes,
            'video'      => current($result['items']),
        ));
    }

    /**
     *
     * @param $attributes
     * @param null $html
     */
    public static function actionPlaylist($attributes, $html = null)
    {
        $params = (array)$attributes;
        if (($search = YoutubeChannelPlugin_Input::param('q'))) {
            $params['q'] = $search;
        }

        $result = YoutubeChannelPlugin_Model_Channel::getPlaylist($attributes['playlist'], $attributes['key'], (int)$attributes['limit'], YoutubeChannelPlugin_Input::param('page'));

        switch ((int)$attributes['columns']) {
            case 3:
                $attributes['columns'] = "col-md-4 col-xs-6";
                $attributes['break'] = true;
                break;
            case 1:
                $attributes['columns'] = "col-md-12";
                $attributes['break'] = false;
                break;
            default:
                $attributes['columns'] = "col-md-6";
                $attributes['break'] = false;

        }

        $uri = get_the_permalink();
        $nextPage = !isset($result['nextPageToken']) ? null : $uri . "?" . http_build_query(array(
                'q'    => YoutubeChannelPlugin_Input::param('q'),
                'page' => $result['nextPageToken'],
            ));
        $previousPage = !isset($result['prevPageToken']) ? null : $uri . "?" . http_build_query(array(
                'q'    => YoutubeChannelPlugin_Input::param('q'),
                'page' => $result['prevPageToken'],
            ));


        echo static::loadView('channel/playlist', array(
            '_header'      => static::getHeader(),
            'html'         => $html,
            'result'       => $result,
            'attributes'   => $attributes,
            'nextPage'     => $nextPage,
            'previousPage' => $previousPage,
        ));
    }

    /**
     *
     * @param $attributes
     * @param null $html
     */
    public static function actionIndex($attributes, $html = null)
    {
        $params = (array)$attributes;
        if (($search = YoutubeChannelPlugin_Input::param('q'))) {
            $params['q'] = $search;
        }

        $result = YoutubeChannelPlugin_Model_Channel::search($params, (int)$attributes['limit'], 'date', YoutubeChannelPlugin_Input::param('page'));

        switch ((int)$attributes['columns']) {
            case 3:
                $attributes['columns'] = "col-md-4 col-xs-6";
                $attributes['break'] = true;
                break;
            case 1:
                $attributes['columns'] = "col-md-12";
                $attributes['break'] = false;
                break;
            default:
                $attributes['columns'] = "col-md-6";
                $attributes['break'] = false;

        }

        $uri = get_the_permalink();
        $nextPage = !isset($result['nextPageToken']) ? null : $uri . "?" . http_build_query(array(
                'q'    => YoutubeChannelPlugin_Input::param('q'),
                'page' => $result['nextPageToken'],
            ));
        $previousPage = !isset($result['prevPageToken']) ? null : $uri . "?" . http_build_query(array(
                'q'    => YoutubeChannelPlugin_Input::param('q'),
                'page' => $result['prevPageToken'],
            ));


        echo static::loadView('channel/index', array(
            '_header'      => static::getHeader(),
            'html'         => $html,
            'result'       => $result,
            'attributes'   => $attributes,
            'nextPage'     => $nextPage,
            'previousPage' => $previousPage,
        ));
    }
}
