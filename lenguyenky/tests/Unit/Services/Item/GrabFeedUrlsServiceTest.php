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

    protected $url = 'https://www.feedforall.com/sample.xml';

    public function boot()
    {
        $this->service = $this->app->make(GrabFeedUrlsService::class);
    }

    public function testGrab()
    {
        $result = $this->service->setData(['url' => $this->url])->grab();
        
        $this->assertNotEmpty((array) $result->channel);
    }

    public function testHandle()
    {
        $result = $this->service->setData(['url' => $this->url])->handle();
        
        $this->assertInstanceOf(Channel::class, $result);
    }

}
