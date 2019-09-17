<?php

namespace App\Repositories;

use App\Models\Channel;
use Ky\Core\Repositories\BaseRepository;

class ChannelRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Channel::class;
    }
}
