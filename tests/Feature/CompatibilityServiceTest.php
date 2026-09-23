<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Services\CompatibilityService;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompatibilityServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);
    }

    public function test_it_detects_socket_conflicts(): void
    {
        $cpu = Product::where('name', 'AMD Ryzen 7 7800X3D')->firstOrFail();
        $mainboard = Product::where('name', 'MSI MAG Z790 Tomahawk WiFi')->firstOrFail();

        $result = app(CompatibilityService::class)->validate(collect([$cpu, $mainboard]));

        $this->assertFalse($result['compatible']);
        $this->assertStringContainsString('Sockel-Konflikt', $result['issues'][0]);
    }

    public function test_it_rejects_a_power_supply_that_is_too_weak(): void
    {
        $cpu = Product::where('name', 'Intel Core i9-14900K')->firstOrFail();
        $mainboard = Product::where('name', 'MSI MAG Z790 Tomahawk WiFi')->firstOrFail();
        $gpu = Product::where('name', 'NVIDIA GeForce RTX 4090')->firstOrFail();
        $psu = Product::where('name', 'be quiet! Pure Power 12 M 550W')->firstOrFail();

        $result = app(CompatibilityService::class)->validate(collect([$cpu, $mainboard, $gpu, $psu]));

        $this->assertFalse($result['compatible']);
        $this->assertSame(728, $result['wattage_used']);
        $this->assertSame(550, $result['wattage_capacity']);
    }

    public function test_it_accepts_a_fully_compatible_build(): void
    {
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

        $result = app(CompatibilityService::class)->validate($products);

        $this->assertTrue($result['compatible']);
        $this->assertSame([], $result['issues']);
    }
}
