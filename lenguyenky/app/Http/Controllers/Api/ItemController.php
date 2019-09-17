<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\ListItemRequest;
use App\Http\Resources\Item\ItemCollection;
use App\Services\Item\ListItemsService;

class ItemController extends Controller
{
    /**
     * @var ListItemsService
     */
    protected $listService;

    public function __construct(
        ListItemsService $listService
    ) {
        $this->listService = $listService;
    }

    public function index(ListItemRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();
        
        return response()->json(new ItemCollection($items));
    }
}
