<?php

namespace App\Services\Channel;

use App\Repositories\ChannelRepository;
use Ky\Core\Services\BaseService;

class ListChannelService extends BaseService
{
    /**
     * @var ChannelRepository
     */
    protected $repository;

    public function __construct(ChannelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        return $this->repository->all();
    }
}
