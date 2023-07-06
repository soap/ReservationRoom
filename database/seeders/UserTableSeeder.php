<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(20)->create();
        // User::insert([
        //     [
        //         'name' => 'test1',
        //         'email' => 'test1@gmail.com',
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$066yz4Hc2jl02oOZiOyc0uNw2.1AGh.4GsQ.fYK0J2r7.6xfXv3aO',
        //         'remember_token' => null
        //     ],
        //     [
        //         'name' => 'test2',
        //         'email' => 'test2@gmail.com',
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$066yz4Hc2jl02oOZiOyc0uNw2.1AGh.4GsQ.fYK0J2r7.6xfXv3aO',
        //         'remember_token' => null
        //     ],
        //     [
        //         'name' => 'test3',
        //         'email' => 'test3@gmail.com',
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$066yz4Hc2jl02oOZiOyc0uNw2.1AGh.4GsQ.fYK0J2r7.6xfXv3aO',
        //         'remember_token' => null
        //     ],
        //     [
        //         'name' => 'test4',
        //         'email' => 'test4@gmail.com',
        //         'email_verified_at' => null,
        //         'password' => '$2y$10$066yz4Hc2jl02oOZiOyc0uNw2.1AGh.4GsQ.fYK0J2r7.6xfXv3aO',
        //         'remember_token' => null
        //     ]
        // ]);
    }
}