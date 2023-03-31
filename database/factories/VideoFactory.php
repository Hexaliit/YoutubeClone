<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'channel_id' => function() {
                return Video::factory()->create()->id;
            },
            'views' => $this->faker->numberBetween(1,10000),
            'thumbnail' => $this->faker->imageUrl(),
            'percentage' => 100,
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(10),
            'path' => $this->faker->word(),
        ];
    }
}
