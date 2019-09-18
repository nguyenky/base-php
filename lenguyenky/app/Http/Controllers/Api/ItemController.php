<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\CreateItemRequest;
use App\Http\Requests\Item\DeleteItemRequest;
use App\Http\Requests\Item\FindItemRequest;
use App\Http\Requests\Item\ListItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Http\Resources\Item\ItemCollection;
use App\Http\Resources\Item\ItemResource;
use App\Services\Item\CreateItemService;
use App\Services\Item\DeleteItemService;
use App\Services\Item\FindItemService;
use App\Services\Item\ListItemsService;
use App\Services\Item\UpdateItemService;

class ItemController extends Controller
{
    /**
     * @var ListItemsService
     */
    protected $listService;

    /**
     * @var FindItemService
     */
    protected $findService;

    /**
     * @var CreateItemService
     */
    protected $createService;

    /**
     * @var UpdateItemService
     */
    protected $updateService;

    /**
     * @var DeleteItemService
     */
    protected $deleteService;

    public function __construct(
        ListItemsService $listService,
        FindItemService $findService,
        CreateItemService $createService,
        UpdateItemService $updateService,
        DeleteItemService $deleteService
    ) {
        $this->listService = $listService;
        $this->findService = $findService;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
    }

    public function index(ListItemRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();
        
        return response()->success(new ItemCollection($items));
    }

    public function show(FindItemRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();
        
        return response()->success(new ItemResource($item));
    }

    public function store(CreateItemRequest $request)
    {
        $item = $this->createService
            ->setRequest($request)
            ->handle();

        return response()->created(new ItemResource($item));
    }

    public function update(UpdateItemRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();
        
        $item = $this->updateService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success(new ItemResource($item));
    }

    public function destroy(DeleteItemRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $this->deleteService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }
}
