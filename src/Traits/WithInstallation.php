<?php

namespace Orchestra\Testing\Traits;

use Orchestra\Foundation\Auth\User;
use Orchestra\Installation\Installation;
use Orchestra\Contracts\Installation\Installation as InstallationContract;

trait WithInstallation
{
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
            'site_name' => $config['name'] ?? 'Orchestra Platform',
            'email'     => $config['email'] ?? 'hello@orchestraplatform.com',
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
        return factory(User::class)->create();
    }
}