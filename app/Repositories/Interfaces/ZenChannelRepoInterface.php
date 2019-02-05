<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\ZenChannelStoreRequest;
use App\Http\Requests\ZenChannelUpdateRequest;

interface ZenChannelRepoInterface
{
    public function create(ZenChannelStoreRequest $request);

    public function update(ZenChannelUpdateRequest $request, $model);

    public function delete($model);
}
