<?php

namespace App\Services\Item;

use App\Repositories\ItemRepository;
use Ky\Core\Services\BaseService;

class DeleteItemService extends BaseService
{
    /**
     * @var ItemRepository
     */
    protected $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->model->delete();
    }
}
