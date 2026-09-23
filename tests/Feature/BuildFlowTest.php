<?php

namespace Tests\Feature;

use App\Models\Build;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BuildFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_the_dashboard(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_user_can_register_and_reaches_the_dashboard(): void
    {
        $response = $this->post('/register', [
            'name' => 'Max Mustermann',
            'email' => 'max@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
        $this->get('/dashboard')->assertSee('Max Mustermann');
    }

    public function test_user_can_save_a_build_from_the_configurator_session(): void
    {
        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);

        $user = User::factory()->create();

        $names = [
            'AMD Ryzen 7 7800X3D',
            'MSI MAG B650 Tomahawk WiFi',
            'G.Skill Trident Z5 32 GB (2x16)',
            'NVIDIA GeForce RTX 4070 Super',
            'be quiet! Straight Power 11 850W',
            'WD Black SN850X 2TB',
            'Fractal Design Meshify 2',
        ];

        $products = collect($names)
            ->map(fn (string $name): Product => Product::where('name', $name)->firstOrFail());

        session(['configurator.products' => $products->pluck('id')->all()]);

        $this->actingAs($user)
            ->post('/builds', ['title' => 'Gaming-PC AM5'])
            ->assertRedirect('/dashboard');

        $this->assertDatabaseHas('builds', ['title' => 'Gaming-PC AM5', 'user_id' => $user->id]);

        $build = Build::where('title', 'Gaming-PC AM5')->firstOrFail();

        $this->assertCount(7, $build->products);
        $this->assertSame((float) $products->sum('price'), $build->total_price);
    }

    public function test_user_can_share_a_private_build(): void
    {
        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);

        $user = User::factory()->create();
        $build = Build::factory()->for($user)->create(['is_public' => false]);

        $this->actingAs($user)
            ->post("/builds/{$build->id}/share")
            ->assertRedirect("/builds/{$build->id}");

        $build->refresh();

        $this->assertTrue($build->is_public);
        $this->assertNotNull($build->share_token);
    }
}
