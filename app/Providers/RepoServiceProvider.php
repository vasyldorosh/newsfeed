<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\NewsRepo;
use App\Repositories\Eloquent\ZenChannelRepo;
use App\Repositories\Interfaces\NewsRepoInterface;
use App\Repositories\Interfaces\ZenChannelRepoInterface;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }

    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(NewsRepoInterface::class, NewsRepo::class);
        $this->app->bind(ZenChannelRepoInterface::class, ZenChannelRepo::class);
    }
}
