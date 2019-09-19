<?php

namespace Tests\Unit\Services\Item;

use App\Models\Item;
use App\Services\Item\FindItemService;
use Tests\TestCase;

class FindItemServicetTest extends TestCase
{
    /**
     * @var \App\Services\Channel\FindItemService
     */
    protected $service;

    /**
     * @var \App\Models\Item
     */
    protected $item;

    /**
     * @var int
     */
    protected $model;

    public function boot()
    {
        $this->service = $this->app->make(FindItemService::class);

        $this->item = factory(Item::class)->create();

        $this->model = $this->item->id;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShouldFindItem()
    {
        $item = $this->service
            ->setData($this->item)
            ->setModel($this->model)
            ->handle();

        $this->assertEquals($item->only($item->getFillable()), $this->item->only($item->getFillable()));
    }
}
