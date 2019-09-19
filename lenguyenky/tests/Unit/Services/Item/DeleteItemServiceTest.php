<?php

namespace Tests\Unit\Services\Item;

use App\Models\Item;
use App\Services\Item\DeleteItemService;
use Tests\TestCase;

class DeleteItemServiceTest extends TestCase
{
    /**
     * @var \App\Services\Channel\DeleteItemService
     */
    protected $service;

    /**
     * @var \App\Models\Item
     */
    protected $model;

    public function boot()
    {
        $this->service = $this->app->make(DeleteItemService::class);

        $this->model = factory(Item::class)->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShouldFindItem()
    {
        $item = $this->service
            ->setModel($this->model)
            ->handle();

        $this->assertTrue($item);
        $this->assertDatabaseMissing('items', [
            'id' => $this->model->id
        ]);
    }
}
