<?php namespace Orchestra\Testing\Http;

use Orchestra\Testbench\Http\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    /**
     * The application's middleware stack.
     *
     * @var array
     */
    protected $bootstrappers = [];

    /**
     * The application's middleware stack.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        ],

        'api' => [],
    ];
}
