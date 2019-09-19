<?php

namespace Tests\Unit\Services\Item;

use App\Models\Item;
use App\Services\Item\ListItemsService;
use Tests\TestCase;

class ListItemSeriveTest extends TestCase
{
    /**
     * @var \App\Services\Channel\ListItemsService
     */
    protected $service;

    /**
     * @var \App\Models\Item
     */
    protected $items;

    public function boot()
    {
        $this->service = $this->app->make(ListItemsService::class);

        $this->items = factory(Item::class, rand(2, 20))->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShouldListItem()
    {
        $items = Item::orderBy('updated_at')->paginate($this->queriesForList['per_page'])->toArray();
        $result = $this->service
            ->setData($this->queriesForList)
            ->handle();
        
        $this->assertEquals($items, $result->toArray());
    }

    /**
     * ListItemsService test filter function.
     *
     * @return void
     */
    public function testShouldAbleToFilterByCategory()
    {
        $itemFilter = Item::where('category', $this->items->first()->category)
            ->paginate($this->queriesForList['per_page'])
            ->toArray();

        $dataFilter = $this->queriesForList;
        $dataFilter['category'] = $this->items->first()->category;

        $result = $this->service
            ->setData($dataFilter)
            ->handle();

        $this->assertEquals($itemFilter, $result->toArray());
    }

    /**
     * ListItemsService test filter function.
     *
     * @return void
     */
    public function testShouldAbleToFilterByChannelId()
    {
        $itemFilter = Item::where('channel_id', $this->items->first()->channel_id)
            ->paginate($this->queriesForList['per_page'])
            ->toArray();

        $dataFilter = $this->queriesForList;
        $dataFilter['channel_id'] = $this->items->first()->channel_id;

        $result = $this->service
            ->setData($dataFilter)
            ->handle();

        $this->assertEquals($itemFilter, $result->toArray());
    }
}
