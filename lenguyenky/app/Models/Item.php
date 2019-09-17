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
        'pubDate'
    ];
}
