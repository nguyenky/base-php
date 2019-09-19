<?php

namespace App\Http\Resources\Item;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->only([
            'id',
            'channel_id',
            'title',
            'description',
            'link',
            'category',
            'comments',
            'pub_date'
        ]);
    }
}
