<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_can_only_be_reached_when_signed_in()
    {
        $this->get('/dashboard')
            ->assertStatus(302)
            ->assertRedirect('/login');

        $this->actingAs(User::factory()->create())
            ->get('/dashboard')
            ->assertStatus(200);
    }
}
