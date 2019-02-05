<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\News;
use App\Policies\NewsPolicy;

class AppServiceProvider extends ServiceProvider
{
/**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        News::class => NewsPolicy::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('url_exists', function ($attribute, $value, $parameters, $validator) {
            $headers = @get_headers($value);
           
            return substr($headers[0], 9, 3) == 200;
        });        
        
        //$this->registerPolicies();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
