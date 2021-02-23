<?php

namespace Tests\Feature\Jetstream;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
use Tests\TestCase;

class ApiTokenPermissionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_token_permissions_can_be_updated()
    {
        if (! Features::hasApiFeatures()) {
            return $this->markTestSkipped('API support is not enabled.');
        }

        $this->actingAs($user = User::factory()->create());

        $token = $user->tokens()->create([
            'name' => 'Test Token',
            'token' => Str::random(40),
            'abilities' => ['image:view', 'image:upload'],
        ]);

        Livewire::test(ApiTokenManager::class)
                    ->set(['managingPermissionsFor' => $token])
                    ->set(['updateApiTokenForm' => [
                        'permissions' => [
                            'image:view',
                            'missing-permission',
                        ],
                    ]])
                    ->call('updateApiToken');

        $this->assertTrue($user->fresh()->tokens->first()->can('image:view'));
        $this->assertFalse($user->fresh()->tokens->first()->can('image:upload'));
        $this->assertFalse($user->fresh()->tokens->first()->can('missing-permission'));
    }
}
