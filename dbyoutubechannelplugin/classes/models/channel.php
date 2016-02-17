<?php

class YoutubeChannelPlugin_Model_Channel extends YoutubeChannelPlugin_Model
{
    public static function forge($attributes = array())
    {
        return new self($attributes);
    }

    public static function getVideo($videoId, $channelId, $key)
    {
        $uri = "https://www.googleapis.com/youtube/v3/videos";
        $data = array(
            'id'        => $videoId,
            'key'       => $key,
            'channelId' => $channelId,
            'part'      => 'snippet,contentDetails'
        );

        $url = $uri . "?" . http_build_query($data);
        $response = wp_remote_get($url);
        return isset($response['body']) ? @json_decode($response['body'], true) : array();

    }

    public static function getPlaylist($playlistId, $key, $limit = 20, $pageToken = null)
    {
        $uri = "https://www.googleapis.com/youtube/v3/playlistItems";
        $data = array(
            'playlistId' => $playlistId,
            'key'        => $key,
            'part'       => 'snippet,contentDetails',
            'maxResults' => (int)$limit > 50 ? 50 : (int)$limit,
            'pageToken'  => $pageToken,
        );

        $url = $uri . "?" . http_build_query($data);
        $response = wp_remote_get($url);
        return isset($response['body']) ? @json_decode($response['body'], true) : array();

    }

    public static function search($searchParams, $limit = 20, $orderBy = 'date', $pageToken = null)
    {
        $uri = "https://www.googleapis.com/youtube/v3/search";
        $data = array(
            'key'        => $searchParams['key'],
            'channelId'  => $searchParams['channel'],
            'part'       => 'snippet,id',
            'order'      => isset($searchParams['q']) ? 'relevance' : $orderBy,
            'maxResults' => (int)$limit > 50 ? 50 : (int)$limit,
            'pageToken'  => $pageToken,
            'q'          => isset($searchParams['q']) ? $searchParams['q'] : null,
            'type'       => 'video',
        );


        $url = $uri . "?" . http_build_query($data);
        $response = wp_remote_get($url);
        return isset($response['body']) ? @json_decode($response['body'], true) : array();
    }

}