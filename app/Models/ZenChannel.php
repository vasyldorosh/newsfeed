<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZenChannel extends Model
{

    public $timestamps = false;

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    public $fillable = [
        'url',
    ];

    public static function getListUrlId()
    {
        $items = self::get();
        $data = [];

        foreach ($items as $item) {
            $data[$item->url] = $item->id;
        }

        return $data;
    }
}
