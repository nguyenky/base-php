<?php

namespace App\Services\Item;

use App\Repositories\ItemRepository;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Services\BaseService;

class ListItemsService extends BaseService
{   
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
        $this->repository->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()));

        return $this->data->has('per_page')
            ? $this->repository->paginate($this->data->get('per_page'))
            : $this->repository->all();
    }

    public function getAllowFilters()
    {
        return [
            'category',
            'channel_id'
        ];
    }
}
