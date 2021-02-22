<?php

namespace Tests\Feature;

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

    public function test_control_panel_can_be_reached_by_site_admins()
    {
        $this->actingAs(
            User::factory()
                ->siteAdmin()
                ->create()
        )
            ->get('/control-panel')
            ->assertStatus(200);
    }

    public function test_control_panel_cant_be_viewed_by_guests_and_regular_users()
    {
        $this->get('/control-panel')
            ->assertStatus(302)
            ->assertRedirect('/login');

        $this->actingAs(User::factory()->create())
            ->get('/control-panel')
            ->assertStatus(403);
    }
}
