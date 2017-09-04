<?php

namespace Orchestra\Testing\BrowserKit;

use Illuminate\Support\Arr;
use Orchestra\Foundation\Auth\User;
use Orchestra\Foundation\Application;
use Orchestra\Installation\Installation;
use Orchestra\Testbench\BrowserKit\TestCase as TestbenchTestCase;
use Orchestra\Contracts\Installation\Installation as InstallationContract;

abstract class TestCase extends TestbenchTestCase
{
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
        return __DIR__.'/../../platform';
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

    /**
     * Make Orchestra Platform installer.
     *
     * @return \Orchestra\Installation\Installation
     */
    protected function makeInstaller()
    {
        $installer = new Installation($this->app);

        $installer->bootInstallerFilesForTesting();
        $installer->migrate();

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });

        return $installer;
    }

    /**
     * Install Orchestra Platform and get the administrator user.
     *
     * @param  string  $class
     * @param  \Orchestra\Contracts\Installation\Installation|null  $installer
     * @param  array  $config
     *
     * @return \Orchestra\Foundation\Auth\User
     */
    protected function install(InstallationContract $installer = null, array $config = [])
    {
        if (is_null($installer)) {
            $installer = $this->makeInstaller();
        }

        $user = $this->createAdminUser();

        $installer->create($user, [
            'site_name' => Arr::get($config, 'name', 'Orchestra Platform'),
            'email'     => Arr::get($config, 'email', 'hello@orchestraplatform.com'),
        ]);

        $this->artisan('migrate');

        $this->app['orchestra.installed'] = true;

        $this->beforeApplicationDestroyed(function () {
            $this->app['orchestra.installed'] = false;
            $this->artisan('migrate:rollback');
        });

        return $user;
    }

    /**
     * Create admin user.
     *
     * @return \Orchestra\Foundation\Auth\User
     */
    protected function createAdminUser()
    {
        return factory(User::class)->create()->first();
    }
}
