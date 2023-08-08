<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AirplaneModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'airplane_name' => $this->faker->name(),
            'airplane_code' => $this->faker->unique()->safeEmail(),
            'airplane_brand_id' => $this->faker->date(),
            'qty_seat'=>1,
            'about'=> $this->faker->name(),
            'status' => 1
        ];
    }
}
