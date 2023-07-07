<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Room;
use Tests\TestCase;

class RoomTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setup(): void
    {
        parent::setup();

        $this->seed();
    }

    public function test_auth_user_can_access_room()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('room'));
        $response->assertStatus(200);
    }

    public function test_unauth_user_can_access_room()
    {
        $response = $this->get('/room');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_auth_user_can_visit_room_create_route()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('room'));
        $response->assertStatus(200);
    }

    public function test_unauth_user_cannot_visit_room_create_route()
    {
        $response = $this->get('/room/create');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    
}
