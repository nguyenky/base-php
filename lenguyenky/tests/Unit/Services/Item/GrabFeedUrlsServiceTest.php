<?php

namespace Tests\Unit\Services\Item;

use App\Models\Channel;
use App\Services\Item\GrabFeedUrlsService;
use Tests\TestCase;

class GrabFeedUrlsServiceTest extends TestCase
{
    /**
     * @var \App\Services\Channel\GrabFeedUrlsService
     */
    protected $service;

    /**
     * @var string
     */
    protected $url = 'https://www.feedforall.com/sample.xml';

    public function boot()
    {
        $this->service = $this->app->make(GrabFeedUrlsService::class);
    }

    public function testHandle()
    {
        $result = $this->service->setData(['url' => $this->url])->handle();
        
        $this->assertInstanceOf(Channel::class, $result);
    }

}
