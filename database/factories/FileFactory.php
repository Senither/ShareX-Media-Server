<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

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
            'extension' => 'zip',
            'size' => function () {
                return \rand(100, 9999999);
            },
            'hash_md5' => function () {
                return \md5(\rand(100, 9999999));
            },
            'hash_sha1' => function () {
                return \sha1(\rand(100, 9999999));
            },
        ];
    }
}
