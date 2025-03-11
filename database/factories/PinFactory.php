<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pin>
 */
class PinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pin_name' => $this->faker->sentence(rand(2, 3)),
            'pin_description' => $this->faker->text(200),
            'image_link' => $this->faker->imageUrl(100, 100),
            'latitude' => $this->faker->latitude(48.040331, 48.086950),
            'longitude' => $this->faker->longitude(19.253627, 19.317141),
        ];
    }
}
