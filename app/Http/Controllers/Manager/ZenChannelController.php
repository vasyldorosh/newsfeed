<?php
namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Resources\ZenChannelCollection;
use App\Http\Resources\ZenChannel as ZenChannelResource;
use App\Http\Requests\ZenChannelStoreRequest;
use App\Http\Requests\ZenChannelUpdateRequest;
use App\Repositories\Interfaces\ZenChannelRepoInterface;
use App\Models\ZenChannel;
use App\Http\Controllers\Controller;

class ZenChannelController extends Controller
{

    protected $repository;

    public function __construct(ZenChannelRepoInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('manager.zen_channel.index', [
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
        return view('manager.zen_channel.create', [
            'model' => [],
        ]);        
    }
    

    public function store(ZenChannelStoreRequest $request)
    {
        $this->repository->create($request);
        
        return redirect()->route('manager.zen_channel.index')->withMessage('Zen канал успешно создан!');
    }

    public function show(int $id)
    {
        $model = $this->repository->findOrFail($id);

        return view('manager.zen_channel.show', [
            'model' => $model,
        ]);        
    }

    public function edit(int $id)
    {
        $model = $this->repository->findOrFail($id);

        return view('manager.zen_channel.edit', [
            'model' => $model,
        ]);        
    }

    public function update(ZenChannelUpdateRequest $request, int $id)
    {
        $model = $this->repository->findOrFail($id);
        $model = $this->repository->update($request, $model);
        
        return redirect()->route('manager.zen_channel.index')->withMessage('Zen канал успешно изменен!');
    }

    public function destroy(int $id)
    {
        $model = $this->repository->findOrFail($id);
        $this->repository->delete($model);
        
        return redirect()->route('manager.zen_channel.index')->withMessage('Zen канал успешно удален!');        
    }
}
