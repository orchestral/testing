<?php

namespace Orchestra\Testing\Tests;

use Orchestra\Foundation\Testing\Installation;
use Orchestra\Testing\TestCase;

class ApplicationTest extends TestCase
{
    use Installation;

    /** @test */
    public function it_uses_testing_as_environment()
    {
        $this->assertEquals('testing', $this->app->environment());
    }

    /** @test */
    public function it_use_default_installed_admin_user()
    {
        $this->assertSame(['Administrator'], $this->adminUser->getRoles()->all());
    }
}
