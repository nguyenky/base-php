<?php

namespace Tests\Unit\Services\Item;

use App\Models\Item;
use App\Services\Item\UpdateItemService;
use Tests\TestCase;

class UpdateItemServiceTest extends TestCase
{
    /**
     * @var \App\Services\Channel\UpdateItemService
     */
    protected $service;

    /**
     * @var \App\Models\Item
     */
    protected $item;

    /**
     * @var \App\Models\Item
     */
    protected $model;

    public function boot()
    {
        $this->service = $this->app->make(UpdateItemService::class);

        $this->item = factory(Item::class)->make();

        $this->model = factory(Item::class)->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShouldUpdateItem()
    {
        $item = $this->service
            ->setData($this->item->toArray())
            ->setModel($this->model)
            ->handle();

        $this->assertEquals($item->only($item->getFillable()), $this->item->only($item->getFillable()));
        $this->assertTrue($item->wasChanged($item->getFillable()));
    }
}
