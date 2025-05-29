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
    public function boot()
    {
        Response::macro('success', function ($data = null, $message = null, $status = 200) {
            $response = [
                'status' => 'success',
                'message' => $message,
            ];

            if (!is_null($data)) {
                $response['data'] = $data;
            }

            return response()->json($response, $status);
        });
    }
}
