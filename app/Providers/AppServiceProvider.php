<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('shortapi', function (){
            return Http::acceptJson()->withHeaders([
                "accept" => "application/json",
                "Authorization" => config('constants.API_KEY')
            ])->baseUrl(config('constants.API_URL'))->retry(3,100);
        });
    }
}
