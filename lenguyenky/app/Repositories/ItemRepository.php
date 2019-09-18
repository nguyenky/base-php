<?php

namespace App\Repositories;

use App\Models\Item;
use Ky\Core\Repositories\BaseRepository;

class ItemRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Item::class;
    }

    /**
     * Get allow relations
     *
     * @return array
     */
    public function getAllowRelations()
    {
        return [
            'channel'
        ];
    }
}
