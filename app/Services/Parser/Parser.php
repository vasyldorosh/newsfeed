<?php
namespace App\Services\Parser;

use App\Models\News;
use App\Models\ZenChannel;

class Parser
{
    const RESOURCE_ZEN = 1;
    const RESOURCE_LIFE = 2;
    const RESOURCE_SURFING_BIRD = 3;
    const RESOURCE_FB = 4;

    public static $parsedItems = [];
    
    public static function hasItem($data)
    {
        return News::where($data)->count();
    }

    public static function addItem($data)
    {
        if (empty($data['title']) || empty($data['content'])) {
            return false;
        }

        $model = false;
        $data['slug'] = str_slug($data['title']);

        try {
            self::$parsedItems[] = $data;
            
        } catch (Exception $e) {
            return false;
        }

        return $model;
    }

    public static function getUrls()
    {
        $urls = [
            'https://life.ru' => 'Life',
            'https://surfingbird.ru' => 'SurfingBird',
            'http://fb.ru' => 'Fb',
        ];

        //$urls = [];
        
        $items = ZenChannel::get();
        foreach ($items as $item) {
            $urls[$item->url] = 'Zen';
        }

        return $urls;
    }

    public static function getListResources()
    {
        return [
            self::RESOURCE_ZEN => 'zen.yandex.ru',
            self::RESOURCE_LIFE => 'life.ru',
            self::RESOURCE_SURFING_BIRD => 'surfingbird.ru',
            self::RESOURCE_FB => 'fb.ru',
        ];
    }
}
