<?php

namespace Tests\Unit\Services\Item;

use App\Models\Item;
use App\Services\Item\CreateItemService;
use Tests\TestCase;

class CreateItemServiceTest extends TestCase
{
    /**
     * @var \App\Services\Channel\CreateItemService
     */
    protected $service;

    /**
     * @var \App\Models\Item
     */
    protected $item;

    public function boot()
    {
        $this->service = $this->app->make(CreateItemService::class);

        $this->item = factory(Item::class)->make();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShouldCreateItem()
    {
        $item = $this->service
            ->setData($this->item->toArray())
            ->handle();

        $this->assertEquals($item->only($item->getFillable()), $this->item->only($item->getFillable()));
        $this->assertEquals(1, Item::count());
    }
}
