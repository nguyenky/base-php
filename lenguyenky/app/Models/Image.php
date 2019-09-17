<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'channel_id',
        'url',
        'title',
        'link',
        'description',
        'width',
        'height'
    ];
}
