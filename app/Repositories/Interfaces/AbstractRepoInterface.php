<?php

namespace App\Repositories\Interfaces;

interface AbstractRepoInterface
{
    public function findOrFail($id);

    public function paginate();
}
