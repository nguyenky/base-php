<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'channel_id',
        'title',
        'description',
        'link',
        'category',
        'comments',
        'pub_date'
    ];

    protected $dates = [
        'pub_date'
    ];

    public function channel()
    {
        return $this->belongsTo(\App\Models\Channel::class);
    }
}
