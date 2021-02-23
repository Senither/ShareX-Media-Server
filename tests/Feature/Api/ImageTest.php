<?php

namespace Tests\Feature\Api;

use App\Identifier\WordlistIdentifier;
use App\Models\Image;
use App\Models\User;
use App\Settings\SettingsManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_paginated_image_results()
    {
        $user = User::factory()->create();

        Image::withoutEvents(function () use ($user) {
            Image::factory(10)->create([
                'user_id' => $user->id,
            ]);
        });

        $this->actingAs($user)
            ->get('/api/images')
            ->assertStatus(200)
            ->assertJson([
                'data' => [],
                'current_page' => 1,
                'from' => 1,
                'total' => 10,
            ]);
    }

    public function test_index_only_returns_images_that_belongs_to_authenticated_user()
    {
        Image::withoutEvents(function () {
            Image::factory(10)->create([
                'user_id' => 1,
            ]);
        });

        $this->actingAs(User::factory()->create())
            ->get('/api/images')
            ->assertStatus(200)
            ->assertJson([
                'total' => 0,
            ]);
    }

    public function test_can_renders_own_image()
    {
        $user = User::factory()->create();

        Image::withoutEvents(function () use ($user) {
            $image = Image::factory()->create([
                'user_id' => $user->id,
            ]);

            $this->actingAs($user)
                ->get('/api/images/' . $image->name)
                ->assertStatus(200)
                ->assertJson([
                    'id' => $image->id,
                    'user_id' => $image->user_id,
                    'name' => $image->name,
                    'extension' => $image->extension,
                ]);
        });
    }

    public function test_cant_find_other_users_image()
    {
        Image::withoutEvents(function () {
            $image = Image::factory()->create();

            $this->actingAs(User::factory()->create())
                ->get('/api/images/' . $image->name)
                ->assertStatus(404);
        });
    }

    public function test_images_can_be_deleted()
    {
        $user = User::factory()->create();

        Image::withoutEvents(function () use ($user) {
            $image = Image::factory()->create([
                'user_id' => $user->id,
            ]);

            $this->actingAs($user)
                ->delete('/api/images/' . $image->name)
                ->assertStatus(204);
        });
    }

    public function test_images_can_only_be_deleted_by_the_owner()
    {
        Image::withoutEvents(function () {
            $image = Image::factory()->create();

            $this->actingAs(User::factory()->create())
                ->delete('/api/images/' . $image->name)
                ->assertStatus(404);
        });
    }

    public function test_can_upload_images()
    {
        Storage::fake('images');

        $response = $this->actingAs(User::factory()->create())
            ->post('/api/images', [
                'image' => UploadedFile::fake()->image('test.png'),
            ])
            ->assertStatus(201);

        $content = json_decode($response->getContent());

        $response = $this->get('/api/images/' . $content->name)
            ->assertStatus(200)
            ->assertJson([
                'extension' => 'png',
            ]);
    }

    public function test_can_upload_gifs()
    {
        Storage::fake('images');

        $response = $this->actingAs(User::factory()->create())
            ->post('/api/images', [
                'image' => UploadedFile::fake()->image('test.gif'),
            ])
            ->assertStatus(201);

        $content = json_decode($response->getContent());

        $response = $this->get('/api/images/' . $content->name)
            ->assertStatus(200)
            ->assertJson([
                'extension' => 'gif',
            ]);
    }
}
