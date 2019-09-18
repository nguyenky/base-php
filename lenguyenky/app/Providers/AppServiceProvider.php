<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerResponseMacros();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function registerResponseMacros()
    {
        /**
         * Return a new JSON response with status code 200.
         *
         * @package \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
         * @param   array  $data
         * @return  \Illuminate\Http\JsonResponse
         */
        Response::macro('success', function ($data) {
            return response()->json($data, 200);
        });

        Response::macro('created', function ($data) {
            return response()->json($data, 201);
        });

        Response::macro('successWithoutData', function () {
            return response()->json([ 'success' => true ], 200);
        });

        Response::macro('notModified', function ($data) {
            return response()->json($data, 304);
        });

        Response::macro('error', function ($data, $statusCode = 400) {
            return response()->json($data, $statusCode);
        });

        Response::macro('notFound', function ($data) {
            return response()->json($data, 404);
        });

        Response::macro('invalid', function ($data) {
            return response()->json($data, 422);
        });

        Response::macro('xml', function ($data) {
            return response($data)->header('Content-Type', 'application/xml');
        });
    }
}
