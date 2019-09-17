<?php

namespace App\Repositories;

use App\Models\Image;
use Ky\Core\Repositories\BaseRepository;

class ImageRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Image::class;
    }
}
