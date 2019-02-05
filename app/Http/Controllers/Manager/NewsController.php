<?php
namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Resources\NewsCollection;
use App\Http\Resources\News as NewsResource;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Repositories\Interfaces\NewsRepoInterface;
use App\Models\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{

    protected $repository;

    public function __construct(NewsRepoInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('manager.news.index', [
            'collection' => $this->repository->paginate(),
        ]);        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.news.create', [
            'model' => [],
        ]);        
    }
    

    public function store(NewsStoreRequest $request)
    {
        $this->repository->create($request);
        
        return redirect()->route('manager.news.index')->withMessage('News create success!');
    }

    public function show(int $id)
    {
        $model = $this->repository->findOrFail($id);

        return view('manager.news.show', [
            'model' => $model,
        ]);        
    }

    public function edit(int $id)
    {
        $model = $this->repository->findOrFail($id);

        return view('manager.news.edit', [
            'model' => $model,
        ]);        
    }

    public function update(NewsUpdateRequest $request, int $id)
    {
        $model = $this->repository->findOrFail($id);
        $model = $this->repository->update($request, $model);
        
        return redirect()->route('manager.news.index')->withMessage('News update success!');
    }

    public function destroy(int $id)
    {
        $model = $this->repository->findOrFail($id);
        $this->repository->delete($model);
        
        return redirect()->route('manager.news.index')->withMessage('News delete success!');        
    }
}
