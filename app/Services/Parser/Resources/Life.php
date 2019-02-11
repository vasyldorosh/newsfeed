<?php
namespace App\Services\Parser\Resources;

use App\Services\Parser\ParserInterface;
use App\Services\Parser\Parser as ParserHelper;
use App\Services\Curl;

class Life implements ParserInterface
{

    private $url;

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function parse(): array
    {
        $items = [];

        $page = (new Curl($this->url))->init()->execute()->close();

        $expl = explode('App.newsFeedPosts =', $page->response);

        if (isset($expl[1])) {
            $expl = explode('</script>', $expl[1]);
            $json = str_replace('}];', '}]', $expl[0]);

            $data = json_decode($json, 1);

            foreach ($data as $dIten) {
                $attrs = [
                    'resource_id' => $this->getResourceId(),
                    'title' => $dIten['title'],
                    'image_url' => $dIten['image']['url'] ?? null,
                    'resource_url' => urldecode($dIten['link']),
                ];

                if (!ParserHelper::hasItem(['resource_id' => $attrs['resource_id'], 'resource_url' => $attrs['resource_url']])) {
                    $itemUrl  = $this->url . $attrs['resource_url'];   
                    echo $itemUrl . "\n";
                    $pageItem = (new Curl($itemUrl))->init()->execute()->close();

                    $explItem = explode('App.post =', $pageItem->response);
                    
                    $content = false;
                    
                    if (isset($explItem[1])) {
                        $explItem = explode('</script>', $explItem[1]);
                        $jsonItem = str_replace('"application/json"};', '"application/json"}', $explItem[0]);
                        $dataItem = json_decode($jsonItem, 1);
                        
                        if (!empty($dataItem['subtitle'])) {
                            $content .= '<p class="post-subtitle">'.$dataItem['subtitle'].'</p>';
                        }
                        
                        if (isset($dataItem['content'])) {
                            $content .= $this->itemContentToString(json_decode($dataItem['content'], 1));
                        }
                        
                        $attrs['content'] = $content;
                    }

                    ParserHelper::addItem($attrs);
                }
            }
        }

        return $items;
    }

    public function itemContentToString($items)
    {
        $content = '';

        foreach ($items as $item) {
            
            if (!in_array($item['type'], ['TEXT', 'VIDEO', 'IMAGE', 'QUOTE', 'WIDGET', 'STREAM', 'CARD_VIDEO', 'SUBTITLE'])) {
                continue;
                echo  "\t" . $item['type'] . "\n";
                //print_r($item);
                //die();
            }
            
            if ($item['type'] == 'TEXT') {
                if (!empty($item['value']['blocks'])) {
                    foreach ($item['value']['blocks'] as $block) {
                        $content .= '<p class="post-content-item">'.$block['text'].'</p>';
                    }
                }
            } elseif ($item['type'] == 'SUBTITLE') {
                if (!empty($item['value']['blocks'])) {
                    foreach ($item['value']['blocks'] as $block) {
                        $content .= '<p class="post-content-item-subtitle">'.$block['text'].'</p>';
                    }
                }
            } elseif (in_array ($item['type'], ['CARD_VIDEO', 'VIDEO'])) {
                $content .= '<iframe class="post-content-video" src="'.$item['video']['path'].'" />';
            } elseif ($item['type'] == 'QUOTE') {
                if (!empty($item['content']['blocks'])) {
                    foreach ($item['content']['blocks'] as $block) {
                        $content .= '<quote class="post-content-item">'.$block['text'].'</quote>';
                    }
                }
            } elseif ($item['type'] == 'IMAGE') {
                $content .= '<p class="post-content-image"><img src="'.$item['image']['path'].'"/></p>';
            
            } elseif ($item['type'] == 'WIDGET') {
                $content .= $item['value'];
            }
        }

        return $content;
    }

    public function getResourceId(): int
    {
        return ParserHelper::RESOURCE_LIFE;
    }
}
