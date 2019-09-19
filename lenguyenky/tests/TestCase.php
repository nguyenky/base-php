<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,
        RefreshDatabase;

    /**
     * @var array
     */
    protected $queriesForList = [
        'per_page' => 5,
        'page' => 1
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->boot();
    }

    protected function boot()
    {
        //
    }
}
