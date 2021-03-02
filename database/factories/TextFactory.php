<?php

namespace Database\Factories;

use App\Models\Text;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TextFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Text::class;

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
            'original_name' => $this->faker->name,
            'extension' => 'txt',
            'content' => Str::random(1000),
        ];
    }
}
