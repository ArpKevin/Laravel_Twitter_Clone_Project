<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{

    /** @test */
    public function admin_can_access_admin_dashboard()
    {
        $adminUser = User::factory()->create(['is_admin' => 1]);

        $response = $this->actingAs($adminUser)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');

        $adminUser->delete();
    }

    /** @test */
    public function regular_user_cannot_access_admin_dashboard()
    {
        $regularUser = User::factory()->create(['is_admin' => 0]);

        $response = $this->actingAs($regularUser)->get(route('admin.dashboard'));

        $response->assertStatus(403);

        $regularUser->delete();
    }
}