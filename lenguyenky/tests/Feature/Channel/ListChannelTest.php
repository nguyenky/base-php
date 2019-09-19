<?php

namespace Tests\Feature\Channel;

use App\Models\Channel;
use App\Services\Channel\ListChannelService;
use Tests\TestCase;

class ListChannelTest extends TestCase
{

    /**
     * @var \App\Services\Channel\ListChannelService
     */
    protected $service;

    /**
     * @var \App\Models\Channel
     */
    protected $channels;

    public function boot()
    {
        $this->service = $this->app->make(ListChannelService::class);

        $this->channels = factory(Channel::class, rand(2, 20))->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShouldListChannel()
    {
        $channels = Channel::all()->toArray();
        $result = $this->service
            ->setData($this->queriesForList)
            ->handle();

        $this->assertEquals($channels, $result->toArray());
    }
}
