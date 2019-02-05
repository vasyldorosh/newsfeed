<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;

interface NewsRepoInterface
{
    public function create(NewsStoreRequest $request);

    public function update(NewsUpdateRequest $request, $news);

    public function delete($news);
}
