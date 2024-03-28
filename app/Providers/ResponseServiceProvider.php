<?php

namespace App\Providers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(ResponseFactory $factory): void
    {
        $factory->macro('success', function ($message = '', $data = null) use ($factory) {
            $format = [
                'ok' => true,
                'message' => $message,
                'data' => $data,
            ];

            return $factory->make($format);
        });

        $factory->macro('error', function (int $code, string $message = '', $errors = []) use ($factory){
            $format = [
                'ok' => false,
                'error_code'=> $code,
                'message' => $message,
                'errors' => $errors,
            ];

            return $factory->make($format, $code);
        });
    }
}
