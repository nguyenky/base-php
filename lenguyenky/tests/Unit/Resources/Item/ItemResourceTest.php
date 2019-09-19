<?php

namespace Tests\Unit\Resources\Item;

use App\Http\Resources\Item\ItemResource;
use App\Models\Item;
use Tests\TestCase;

class ItemResourceTest extends TestCase
{
    
    public function boot()
    {
        $this->item = factory(Item::class)->create();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testItemResource()
    {
        $resource = new ItemResource($this->item);

        $this->assertArraySubset($this->item->only(
            'id',
            'channel_id',
            'title',
            'description',
            'link',
            'category',
            'comments',
            'pub_date'
        ), $resource->toArray($this->item));
    }
}
