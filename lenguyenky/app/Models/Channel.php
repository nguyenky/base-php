<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    const HTTP_REGEX = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w\.-]*)*\/?$/';
    
    protected $fillable = [
        'title',
        'description',
        'link',
        'category',
        'copyright',
        'docs',
        'language',
        'lastBuildDate',
        'managingEditor',
        'pub_date',
        'webMaster',
        'generator'
    ];
}
