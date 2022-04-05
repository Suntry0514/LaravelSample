<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\factory;
use App\Models\User;


class  HelloTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHello()
    {
        $this->assertTrue(true);

        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/pagination');
        $response->assertStatus(302);

        //Laravel8より前の書き方
        //$user = factory(User::class)->create();
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user =User::factory()->create();
        $response = $this->actingAs($user)->get('/pagination');
        $response->assertStatus(200);

        $response = $this->get('/no_route');
        $response->assertStatus(404);
    }
}
