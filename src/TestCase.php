<?php

namespace Orchestra\Testing;

use Orchestra\Foundation\Application;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

abstract class TestCase extends TestbenchTestCase
{
    use Traits\WithInstallation;

    /**
     * Override application bindings.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function overrideApplicationBindings($app)
    {
        return [
            'Illuminate\Foundation\Bootstrap\LoadConfiguration' => 'Orchestra\Config\Bootstrap\LoadConfiguration',
        ];
    }

    /**
     * Get package bootstrapper.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageBootstrappers($app)
    {
        return [
            'Orchestra\Foundation\Bootstrap\LoadFoundation',
            'Orchestra\Foundation\Bootstrap\UserAccessPolicy',
            'Orchestra\Extension\Bootstrap\LoadExtension',
            'Orchestra\Foundation\Bootstrap\LoadUserMetaData',
            'Orchestra\View\Bootstrap\LoadCurrentTheme',
            'Orchestra\Foundation\Bootstrap\LoadExpresso',
        ];
    }

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
     * Get base path.
     *
     * @return string
     */
    protected function getBasePath()
    {
        return __DIR__.'/../platform';
    }

    /**
     * Resolve application implementation.
     *
     * @return \Illuminate\Foundation\Application
     */
    protected function resolveApplication()
    {
        return new Application($this->getBasePath());
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
