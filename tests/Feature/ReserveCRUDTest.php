<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Reserve;
use App\Models\Room;
use Tests\TestCase;

class ReserveCRUDTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_store_new_reserve()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();
        $response = $this->actingAs($user)->post(route('reserve.store'), [
            'room_id' => $room->id,
            'title' => 'Meeting 1',
            'name' => $user->name,
            'date' => '2023-07-06',
            'start_time'=>'16:30',
            'stop_time'=>'19:00',
            'participant' => ['1', '2', '3', '4'],
        ]);
        $response->assertSessionHasNoErrors();
        $this->assertCount(1, Reserve::all());
        $this->assertDatabaseHas('reserves', [
            'room_id' => $room->id,
            'title' => 'Meeting 1',
            'name' => $user->name,
            'start_time'=>'2023-07-06 16:30',
            'stop_time'=>'2023-07-06 19:00',
            'participant' => '1,2,3,4'
        ]);
        $response->assertRedirect('/room');
    }

    public function test_user_can_edit_reserve()
    {
        Room::factory()->create();
        $user = User::factory()->create();
        $reserve = Reserve::factory()->create();
        $response = $this->actingAs($user)->get('/reserve/' . $reserve->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee($reserve->title);
    }

    public function test_user_can_update_reserve()
    {
        $room = Room::factory()->create();
        $user = User::factory()->create();
        Reserve::factory()->create();
        $this->assertCount(1, Reserve::all());
        $reserve = Reserve::first();
        $response = $this->actingAs($user)->put('/reserve/' . $reserve->id, [
            'room_id' => $room->id,
            'title' => 'Meeting 1',
            'name' => $user->name,
            'date' => '2023-07-06',
            'start_time'=>'16:30',
            'stop_time'=>'19:00',
            'participant' => ['1', '2', '3', '4']
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/room');
        $this->assertEquals('Meeting 1', Reserve::first()->title);
    }

    public function test_user_can_delete_reserve()
    {
        Room::factory()->create();
        $user = User::factory()->create();
        $reserve = Reserve::factory()->create();
        $this->assertEquals(1, Reserve::count());
        $response = $this->actingAs($user)->delete('/reserve/' . $reserve->id);
        $response->assertStatus(302);
        $this->assertEquals(0, Reserve::count());
    }
}
