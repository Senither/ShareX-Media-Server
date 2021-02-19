<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => Str::random(10),
            'extension' => 'png',
            'height' => $this->faker->numberBetween(16, 128),
            'width' => $this->faker->numberBetween(16, 128),
            'size' => $this->faker->numberBetween(128, 512),
        ];
    }
}
