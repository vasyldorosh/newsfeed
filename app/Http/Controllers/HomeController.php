<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

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
        $model = News::where(['slug'=>$slug])->first();
        
        if (empty($model)) {
            abort(404);
        }
        
        //dd($model);
        
        return view('news_view', [
            'model' => $model->toArray(),
        ]);
    }
}
