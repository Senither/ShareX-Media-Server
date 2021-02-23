<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class RenderImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_not_found_is_thrown_when_no_image_exist()
    {
        $this->get(route('view-image', 'test'))->assertStatus(404);
    }

    public function test_image_is_rendered_if_it_exists()
    {
        Storage::fake('images');

        $response = $this->actingAs(User::factory()->create())
            ->post('/api/images', [
                'image' => UploadedFile::fake()->image('test.png'),
            ])
            ->assertStatus(201);

        $content = json_decode($response->getContent());

        $response = $this->get(route('view-image', $content->name))
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'image/png');
    }
}
