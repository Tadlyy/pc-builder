<?php

namespace Tests\Feature;

use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Models\User;
use Filament\Auth\Pages\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_the_filament_login_page(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_non_admin_user_is_forbidden_from_the_admin_panel(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_admin_can_access_the_panel_dashboard(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk()
            ->assertSee('PC Builder Admin');
    }

    public function test_admin_can_open_the_product_and_category_resources(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get(ListProducts::getUrl())
            ->assertOk()
            ->assertSee('Produkte');

        $this->actingAs($admin)
            ->get(ListCategories::getUrl())
            ->assertOk()
            ->assertSee('Kategorien');
    }

    public function test_non_admin_user_cannot_sign_in_through_the_filament_login_page(): void
    {
        $user = User::factory()->create([
            'email' => 'plain.user@example.com',
            'password' => 'secret123',
        ]);

        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'plain.user@example.com',
                'password' => 'secret123',
            ])
            ->call('authenticate')
            ->assertHasFormErrors();

        $this->assertGuest();
    }

    public function test_admin_can_sign_in_through_the_filament_login_page(): void
    {
        $admin = User::factory()->admin()->create([
            'email' => 'admin.user@example.com',
            'password' => 'secret123',
        ]);

        Livewire::test(Login::class)
            ->fillForm([
                'email' => 'admin.user@example.com',
                'password' => 'secret123',
            ])
            ->call('authenticate')
            ->assertHasNoFormErrors();

        $this->assertAuthenticatedAs($admin);
    }
}
