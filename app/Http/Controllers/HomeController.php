<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Services\Curl;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $offset = isset($_GET['offset']) ? (int) $_GET['offset'] : 0;

        $items = News::getItems($offset);

        return view($request->ajax() ? '_items' : 'home', [
            'items' => $items,
        ]);
    }

    public function news($slug)
    {
        $model = News::where(['slug' => $slug])->first();

        if (empty($model)) {
            abort(404);
        }

        //dd($model);

        return view('news_view', [
            'model' => $model->toArray(),
        ]);
    }

    public function i()
    {
        $image = isset($_GET['image']) ? $_GET['image'] : false;
        if (substr($image, 0, 2) == '//') {
            $image = 'https:' . $image;
        }
        $file_extension = strtolower(substr(strrchr($image, "."), 1));
        $ctype = 'image/jpeg';
        switch ($file_extension) {
            case "gif": $ctype = "image/gif";
                break;
            case "png": $ctype = "image/png";
                break;
            case "jpeg":
            case "jpg": $ctype = "image/jpeg";
                break;
            default:
        }
        
        if ($image) {
            $data = @file_get_contents($image);
            if (empty($data)) {
                $data = (new Curl($image, ['Content-Type: ' . $ctype]))->init()->execute()->close()->getResponse();
            }
            
            return response($data, 200)->header('Content-Type', $ctype);            
        }
    }
}
