<?php
namespace App\Services\Parser\Resources;

use App\Services\Parser\ParserInterface;
use App\Services\Parser\Parser as ParserHelper;
use App\Services\Curl;

class Fb implements ParserInterface
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

        $document = \phpQuery::newDocumentHTML($page->response);

        foreach ($document->find('li.rise__list-item a.rise__list-link') as $postItem) {
            $postItem = pq($postItem);

            $attrs = [
                'resource_id' => $this->getResourceId(),
                'title' => $postItem->text(),
                'resource_url' => $postItem->attr('href'),
            ];

            if (!ParserHelper::hasItem(['resource_id' => $attrs['resource_id'], 'resource_url' => $attrs['resource_url']])) {
                $itemUrl = $this->url . $attrs['resource_url'];
                echo $itemUrl . "\n";

                $pageItem = (new Curl($itemUrl))->init()->execute()->close();

                $documentItem = \phpQuery::newDocumentHTML($pageItem->response);
                pq($documentItem->find('.intext'))->remove();
                
                $attrs['image_url'] = pq($documentItem->find('.pagewrap .fotorama a:first'))->attr('href');
                if (empty($attrs['image_url'])) {
                    $attrs['image_url'] = pq($documentItem->find('.pagewrap img:first'))->attr('src');
                }

                $content = '';

                $mainImg = pq($documentItem->find('.fotorama img:first'))->attr('src');
                
                $content .= pq($documentItem->find('#content'))->html();

                $documentContent = \phpQuery::newDocumentHTML($content);
                foreach ($documentContent->find('img') as $imgItem) {
                    $imgItem = pq($imgItem);

                    if (!substr_count($imgItem->attr('src'), '//fb.ru')) {
                        $imgItem->attr('src', '//fb.ru' . $imgItem->attr('src'));
                    }
                }
                $attrs['content'] = $documentContent->html();

                $items[] = ParserHelper::addItem($attrs);
            }
        }

        return $items;
    }

    public function getResourceId(): int
    {
        return ParserHelper::RESOURCE_FB;
    }
}
