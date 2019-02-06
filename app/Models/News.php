<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\Parser\Parser;

class News extends Model
{

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    public $fillable = [
        'title',
        'image_url',
        'description',
        'resource_url',
        'resource_id',
        'zen_channel_id',
        'content',
        'slug',
    ];

    public static function getItems($offset = 0)
    {
        return self::orderBy('created_at', 'desc')
                ->offset($offset)
                ->limit(16)
                ->get()
                ->toArray();
    }

    public function getDescription()
    {
        return 'aaa';
    }

    public function toArray()
    {
        $mapResources = Parser::getListResources();
        $resource = isset($mapResources[$this->resource_id]) ? $mapResources[$this->resource_id] : null;
        
        $resource_url = $this->resource_url;
        if (!substr_count($resource_url, $resource)) {
            $resource_url = '//' . $resource . $resource_url;
        }
        
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image_url' => $this->image_url,
            'description' => !empty($this->description) ? $this->description : str_limit(strip_tags($this->content), 150, '...'),
            'resource' => $resource,
            'resource_url' => $resource_url,
            'content' => $this->content,
            'url' => route('news.view', ['slug' => $this->slug]),
        ];
    }
}
