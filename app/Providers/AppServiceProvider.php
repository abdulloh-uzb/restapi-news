<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Log;

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
    
        RateLimiter::for("api", function(Request $request){
            Log::info("hello how are you");
            return Limit::perMinute(1)->by($request->ip());
        });


        // RateLimiter::for('test', function ($request) {
        //     return Limit::perMinute(1);
        // });

    }
}
