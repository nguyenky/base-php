<?php

namespace App\Http\Controllers\WebView;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\DeleteItemRequest;
use App\Http\Requests\Item\FindItemRequest;
use App\Http\Requests\Item\ListItemRequest;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Services\Channel\ListChannelService;
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

    /**
     * @var ListChannelService
     */
    protected $listChannelService;

    public function __construct(
        ListItemsService $listService,
        FindItemService $findService,
        CreateItemService $createService,
        UpdateItemService $updateService,
        DeleteItemService $deleteService,
        ListChannelService $listChannelService
    ) {
        $this->listService = $listService;
        $this->findService = $findService;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->listChannelService = $listChannelService;
    }
    
    public function index(ListItemRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->setWith('channel')
            ->handle();

        $channels = $this->listChannelService->handle();
        
        return view('item.index', [
            'items' => $items,
            'channels' => $channels
        ]);
    }

    public function edit(FindItemRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $channels = $this->listChannelService->handle();
        
        return view('item.edit', [
            'channels' => $channels,
            'item' => $item
        ]);
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
        
        return redirect()->route('items.index');
    }

    public function create()
    {
        $channels = $this->listChannelService->handle();

        return view('item.create', [
            'channels' => $channels
        ]);
    }

    public function store(StoreItemRequest $request)
    {
        $this->createService
            ->setRequest($request)
            ->handle();

        return redirect()->route('items.index');
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

        return redirect()->route('items.index');
    }

    public function show(FindItemRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->setWith('channel')
            ->handle();
        
        return view('item.show', [
            'item' => $item
        ]);
    }
}
