<?php namespace Orchestra\Testing;

use Orchestra\Foundation\Application;

abstract class ApplicationTestCase extends TestCase
{
    /**
     * Base application namespace.
     *
     * @var string
     */
    protected $baseNamespace = 'App';

    /**
     * Get application aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getApplicationAliases($app)
    {
        return $app['config']['app.aliases'];
    }

    /**
     * Get application providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getApplicationProviders($app)
    {
        return $app['config']['app.providers'];
    }

    /**
     * Resolve application implementation.
     *
     * @return \Illuminate\Foundation\Application
     */
    protected function resolveApplication()
    {
        $app = new Application($this->getBasePath());

        $app->singleton('Illuminate\Foundation\Bootstrap\LoadConfiguration', 'Orchestra\Config\Bootstrap\LoadConfiguration');

        return $app;
    }

    /**
     * Resolve application Console Kernel implementation.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function resolveApplicationConsoleKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Console\Kernel', "{$this->baseNamespace}\Console\Kernel");
    }

    /**
     * Resolve application HTTP Kernel implementation.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', "{$this->baseNamespace}\Http\Kernel");
    }

    /**
     * Resolve application HTTP exception handler.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function resolveApplicationExceptionHandler($app)
    {
        $app->singleton('Illuminate\Contracts\Debug\ExceptionHandler', "{$this->baseNamespace}\Exceptions\Handler");
    }
}
