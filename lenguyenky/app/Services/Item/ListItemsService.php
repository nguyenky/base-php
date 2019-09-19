<?php

namespace App\Services\Item;

use App\Repositories\ItemRepository;
use App\Services\HelperServiceTrait;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Criteria\OrderCriteria;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;

class ListItemsService extends BaseService
{
    use HelperServiceTrait;

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
        $this->repository->pushCriteria(new WithRelationsCriteria(
            $this->data->get('with'),
            $this->repository->getAllowRelations()
        ));
        $this->repository->pushCriteria(new OrderCriteria($this->data->get('order')));

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
