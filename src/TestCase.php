<?php

namespace Orchestra\Testing;

use Orchestra\Foundation\Auth\User;
use Orchestra\Foundation\Application;
use Orchestra\Foundation\Testing\Installation;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Orchestra\Foundation\Testing\Concerns\WithInstallation;

abstract class TestCase extends TestbenchTestCase
{
    use WithInstallation;

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
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
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
     *
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
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [];
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

    /**
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();

        if (isset($uses[Installation::class])) {
            $this->beginInstallation();
        }

        return $uses;
    }

    /**
     * Create admin user.
     *
     * @return \Orchestra\Foundation\Auth\User
     */
    protected function createAdminUser()
    {
        return factory(User::class)->create();
    }
}
