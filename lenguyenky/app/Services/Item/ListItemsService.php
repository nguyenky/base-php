<?php

namespace App\Services\Item;

use App\Repositories\ItemRepository;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;
use App\Services\Item\HelperTrait;

class ListItemsService extends BaseService
{   
    use HelperTrait;

    protected $collectsData = true;

    /**
     * @var ItemRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $with = null;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->prepareWithData();
        
        $this->repository->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()));
        $this->repository->pushCriteria(new WithRelationsCriteria($this->data->get('with'), $this->repository->getAllowRelations()));

        return $this->repository->paginate($this->getPerPage());
    }

    public function getAllowFilters()
    {
        return [
            'category',
            'channel_id'
        ];
    }
}
