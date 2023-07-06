<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return ["room_name" => $this->faker->jobTitle(),
            "color" => $this->faker->hexColor(),
            "max_participant" => $this->faker->numberBetween(2, 100),
            "image" => $this->faker->regexify("[0-9]{10}\.(jpg|jpeg|png|gif|svg)"),
            "admin_permission" => $this->faker->numberBetween(0, 1)];
    }
}
