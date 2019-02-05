<?php
namespace App\Repositories\Eloquent;

use App\Image;
use App\Models\ZenChannel;
use App\Http\Requests\ZenChannelStoreRequest;
use App\Http\Requests\ZenChannelUpdateRequest;
use App\Repositories\Interfaces\ZenChannelRepoInterface;

class ZenChannelRepo extends AbstractRepo implements ZenChannelRepoInterface
{

    public function __construct()
    {
        parent::__construct('ZenChannel');
    }

    public function create(ZenChannelStoreRequest $request)
    {
        return ZenChannel::create([
                'url' => $request->url,
        ]);
    }

    public function update(ZenChannelUpdateRequest $request, $model)
    {
        return $model->update([
                'url' => $request->url,
        ]);
    }

    public function delete($model)
    {
        $model->delete();
    }
}
