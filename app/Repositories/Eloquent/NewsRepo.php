<?php
namespace App\Repositories\Eloquent;

use App\Image;
use App\Models\News;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Repositories\Interfaces\NewsRepoInterface;

class NewsRepo extends AbstractRepo implements NewsRepoInterface
{

    public function __construct()
    {
        parent::__construct('News');
    }

    public function create(NewsStoreRequest $request)
    {
        $slug = !empty($request->slug) ? $request->slug : $request->title;

        return News::create([
                'title' => $request->title,
                'slug' => str_slug($slug),
                'content' => $request->content,
                'category_id' => $request->category_id,
        ]);
    }

    public function update(NewsUpdateRequest $request, $news)
    {
        $slug = !empty($request->slug) ? $request->slug : $request->title;

        return $news->update([
                'title' => $request->title,
                'slug' => str_slug($slug),
                'content' => $request->content,
                'category_id' => $request->category_id,
        ]);
    }

    public function delete($news)
    {
        $news->delete();
    }
}
