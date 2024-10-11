<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

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
        // set macro for response
        Response::macro('data', function ($data = [], string $message = '', int $status = 200) {
            return response()->json([
                'message' => $message,
                'data'    => $data
            ], $status);
        });

        Response::macro('dataWithAdditional', function ($data = [], string $message = '', int $status = 200, array $additional = []) {
            return $data->additional(array_merge([
                'message' => $message
            ], $additional))->response()->setStatusCode($status);
        });
    }
}
