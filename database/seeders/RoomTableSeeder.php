<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::factory()->count(5)->create();
        // Room::insert([
        //     [
        //         'room_name' => 'convention1',
        //         'color' => '#37F892',
        //         'max_participant' => 10,
        //         'image' => '1687507962.jpg',
        //         'admin_permission' => 0
        //     ],
        //     [
        //         'room_name' => 'convention2',
        //         'color' => '#56F892',
        //         'max_participant' => 15,
        //         'image' => '1687507962.jpg',
        //         'admin_permission' => 0
        //     ]
        // ]);
    }
}