<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Reserve;
use Tests\TestCase;

class ReserveTest extends TestCase
{
    use RefreshDatabase;

    private $reserve;

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

    public function test_auth_user_can_access_reserve()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/reserve');
        $response->assertStatus(200);
    }

    public function test_unauth_user_can_access_reserve()
    {
        $response = $this->get('/reserve');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    
}
