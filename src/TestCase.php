<?php namespace Orchestra\Testing;

use Orchestra\Foundation\Application;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

abstract class TestCase extends TestbenchTestCase
{
    /**
     * Get application aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getApplicationAliases($app)
    {
        return $app['config']['app.aliases'];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [];
    }

    /**
     * Get application providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getApplicationProviders($app)
    {
        return $app['config']['app.providers'];
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application   $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['router']->disableFilters();
    }

    /**
     * Get base path.
     *
     * @return string
     */
    protected function getBasePath()
    {
        return __DIR__.'/../fixture';
    }

    /**
     * Resolve application implementation.
     *
     * @return \Illuminate\Foundation\Application
     */
    protected function resolveApplication()
    {
        $app = new Application($this->getBasePath());

        $app->bind('Illuminate\Foundation\Bootstrap\LoadConfiguration', 'Orchestra\Config\Bootstrap\LoadConfiguration');

        return $app;
    }

    /**
     * Resolve application implementation.
     *
     * @param \Illuminate\Foundation\Application  $app
     */
    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', 'Orchestra\Testing\Http\Kernel');
    }
}
