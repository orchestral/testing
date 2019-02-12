<?php

namespace Orchestra\Testing\Tests;

use Illuminate\Routing\Router;
use Orchestra\Testing\TestCase;

class ApplicationTest extends TestCase
{
    /** @test */
    public function it_uses_testing_as_environment()
    {
        $this->assertEquals('testing', $this->app->environment());
    }
}
