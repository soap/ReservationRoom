<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Room;
use App\Models\User;
use Tests\TestCase;

class TimeSlotTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth_user_can_visit_timeslot()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/reserve_timeslot');
        $response->assertStatus(200);
    }

    public function test_unauth_user_cannot_visit_timeslot()
    {
        $response = $this->get('/reserve_timeslot');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_auth_user_can_visit_timeslot_with_date()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/reserve_timeslot/15-08-2023');
        $response->assertStatus(200);
    }
    
    public function test_unauth_user_cannot_visit_timeslot_with_date()
    {
        $response = $this->get('/reserve_timeslot/15-08-2023');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_user_can_visit_timeslot_with_date_can_render_table_mon_to_fri()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $response = $this->actingAs($user)->get('/reserve_timeslot/15-08-2023');
        $response->assertStatus(200);
        $response->assertSee('14-08-2023');
        $response->assertSee('15-08-2023');
        $response->assertSee('16-08-2023');
        $response->assertSee('17-08-2023');
        $response->assertSee('18-08-2023');
        $response->assertSee('08:00');
        $response->assertSee('00:00');
        $response->assertSee('19:00');
        $response->assertSee('20:00');
        $response->assertSee($room->room_name);
    }
}
