<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Room;
use Tests\TestCase;

use Illuminate\Http\UploadedFile;

class RoomCRUDTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_store_new_room()
    {
        $user = User::factory()->create();
        $image = UploadedFile::fake()->image('room_image.png', 640, 480);
        $response = $this->actingAs($user)->post(route('room.store'), [
            'name' => 'Convention1',
            'color' => '#ffffff',
            'max_participant' => 5,
            'image' => $image,
            'admin_permission' => 'off'
        ]);
        $response->assertSessionHasNoErrors();
        $this->assertCount(1, Room::all());
        $this->assertDatabaseHas('rooms', [
            'room_name' => 'Convention1',
            'color' => '#ffffff',
            'max_participant' => 5,
            'admin_permission' => 0
        ]);
        $response->assertRedirect('/room');
    }

    public function test_user_can_edit_room()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();
        $response = $this->actingAs($user)->get('/room/' . $room->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee($room->name);
    }

    public function test_user_can_update_room()
    {
        $image = UploadedFile::fake()->image('room_image.png', 640, 480);
        $user = User::factory()->create();
        Room::factory()->create();
        $this->assertCount(1, Room::all());
        $room = Room::first();
        $response = $this->actingAs($user)->put('/room/' . $room->id, [
            'name' => 'Convention1',
            'color' => '#ffffff',
            'max_participant' => 5,
            'image' => $image,
            'admin_permission' => 'off'
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/room');
        $this->assertEquals('Convention1', Room::first()->room_name);
    }

    public function test_user_can_delete_room()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();
        $this->assertEquals(1, Room::count());
        $response = $this->actingAs($user)->delete('/room/' . $room->id);
        $response->assertStatus(302);
        $this->assertEquals(0, Room::count());
    }
}