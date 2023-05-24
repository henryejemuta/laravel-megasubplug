<?php

namespace HenryEjemuta\LaravelMegaSubPlug\Tests;

use HenryEjemuta\LaravelMegaSubPlug\MegaSubPlugServiceProvider;
use Orchestra\Testbench\TestCase;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [MegaSubPlugServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
