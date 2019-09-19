<?php

namespace App\Services\Item;

use App\Repositories\ItemRepository;
use App\Services\HelperServiceTrait;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;

class FindItemService extends BaseService
{
    use HelperServiceTrait;

    protected $collectsData = true;
    /**
     * @var string
     */
    protected $with = null;

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
        $this->prepareWithData();

        $this->repository->pushCriteria(new WithRelationsCriteria(
            $this->data->get('with'),
            $this->repository->getAllowRelations()
        ));

        return $this->repository->find($this->model);
    }
}
