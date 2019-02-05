<?php
namespace App\Services\Parser\Resources;

use App\Services\Parser\ParserInterface;
use App\Services\Parser\Parser as ParserHelper;
use App\Services\Curl;

class SurfingBird implements ParserInterface
{

    private $url;
    
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function parse() : array
    {
        $items = [];

        $page = (new Curl($this->url))->init()->execute()->close();

        $document = \phpQuery::newDocumentHTML($page->response);
        
        foreach ($document->find('.exchange-feed-item') as $postItem) {
            $postItem = pq($postItem);
            
            $attrs = [
                'resource_id' => $this->getResourceId(),
                'title' => pq($postItem->find('.exchange-feed-item__title'))->text(),
                'image_url' => pq($postItem->find('img'))->attr('src'),
                'resource_url' => str_replace('//surfingbird.ru/', '/', $postItem->attr('href')),
            ];
                
            if (!ParserHelper::hasItem(['resource_id' => $attrs['resource_id'], 'resource_url' => $attrs['resource_url']])) {
                $itemUrl  = $this->url . $attrs['resource_url'];   
                echo $itemUrl . "\n";
                $pageItem = (new Curl($itemUrl))->init()->execute()->close();

                $documentItem = \phpQuery::newDocumentHTML($pageItem->response);
                $documentContent = \phpQuery::newDocumentHTML(pq($documentItem->find('#b-parser')));
                
                $documentContent->find('#b-parser__more-share_email-square')->remove();
                $documentContent->find('.b-parser__buttons')->remove();
                $documentContent->find('.b-parser__text')->remove();
                $documentContent->find('.read_more_button')->remove();
                $documentContent->find('.read_more_button_overlay')->remove();
                
                $attrs['content'] = $documentContent->find('div:first div')->html();
                
                $items[] = ParserHelper::addItem($attrs);
            }

        }

        return $items;
    }

    public function getResourceId() : int
    {
        return ParserHelper::RESOURCE_SURFING_BIRD;
    }
}
