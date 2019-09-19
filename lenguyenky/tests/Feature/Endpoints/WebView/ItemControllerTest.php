<?php

namespace Tests\Feature\Endpoints\WebView;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = factory(User::class)->create();

        $this->get(route('items.index'))->assertStatus(400);

        $this->actingAs($user);

        $this->get(route('items.index'))->assertStatus(200);
    }
}
