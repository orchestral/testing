<?php

namespace Orchestra\Testing\Tests;

use Orchestra\Testing\TestCase;

class ApplicationTest extends TestCase
{
    /** @test */
    public function it_uses_testing_as_environment()
    {
        $this->assertEquals('testing', $this->app->environment());
    }
}
