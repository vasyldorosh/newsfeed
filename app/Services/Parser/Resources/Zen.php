<?php
namespace App\Services\Parser\Resources;

use App\Services\Parser\ParserInterface;
use App\Services\Parser\Parser as ParserHelper;
use App\Services\Curl;
use App\Models\ZenChannel;

class Zen implements ParserInterface
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
        $url = trim($this->url, '/');
        $page = (new Curl($url))->init()->execute()->close();

        $expl = explode('/', $url);

        $params = [
            'channel_name' => $expl[count($expl) - 1],
        ];

        $matchData = [
            'clid' => '#\"clid\"\:\"(.*?)\"#',
            '_csrf' => '#\_csrf\=(.*?)\&#',
            'next_page_id' => '#next_page_id\=(.*?)\&#',
        ];

        foreach ($matchData as $k => $pattern) {
            preg_match($pattern, $page->response, $match);
            if (isset($match[1])) {
                $params[$k] = $match[1];
            }
        }

        $urlApi = "https://zen.yandex.ru/api/v3/launcher/more?channel_name={$params['channel_name']}&clid={$params['clid']}&country_code=ru&_csrf={$params['_csrf']}&token=&next_page_id={$params['next_page_id']}&skip-banner=";
        $pageApi = (new Curl($urlApi))->init()->execute()->close();
        $data = json_decode($pageApi->response, 1);

        $mapChannelUrlId = ZenChannel::getListUrlId();
        
        if (isset($data['items'])) {
            foreach ($data['items'] as $dItem) {
                if ($dItem['type'] != 'card') {
                    continue;
                }

                $expl = explode('?', $dItem['link']);

                $attrs = [
                    'resource_id' => $this->getResourceId(),
                    'zen_channel_id' => isset($mapChannelUrlId[$this->url]) ? $mapChannelUrlId[$this->url] : null,
                    'title' => $dItem['title'],
                    'description' => $dItem['text'],
                    'image_url' => $dItem['image'],
                    'resource_url' => $expl[0],
                ];

                if (!ParserHelper::hasItem(['resource_id' => $attrs['resource_id'], 'resource_url' => $attrs['resource_url']])) {
                    $itemUrl = $attrs['resource_url'];
                    echo "\n" . $itemUrl . "\n";

                    $pageItem = (new Curl($itemUrl))->init()->execute()->close();
                    $documentItem = \phpQuery::newDocumentHTML($pageItem->response);

                    foreach ($documentItem->find('img[data-src]') as $figureImg) {
                        $figureImg = pq($figureImg);

                        $figure = pq($figureImg->parents('figure'));
                        $figure->before('<img src="' . $figureImg->attr('data-src') . '" />');
                        $figure->remove();
                    }

                    $attrs['content'] = pq($documentItem->find('.article__body'))->html();

                    ParserHelper::addItem($attrs);
                }
            }
        }

        return $items;
    }

    public function getResourceId(): int
    {
        return ParserHelper::RESOURCE_ZEN;
    }
}
