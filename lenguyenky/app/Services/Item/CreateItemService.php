<?php

namespace App\Services\Item;

use App\Repositories\ItemRepository;
use App\Services\HelperServiceTrait;
use Ky\Core\Services\BaseService;

class CreateItemService extends BaseService
{
    use HelperServiceTrait;

    protected $collectsData = true;

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
        $this->perepareData();

        return $this->repository->create($this->data->toArray());
    }
}
