<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Define the hardware catalog data.
     *
     * @return array<string, array<int, array<string, mixed>>>
     */
    private function products(): array
    {
        return [
            'cpu' => [
                ['name' => 'AMD Ryzen 5 7600', 'price' => 229, 'specs' => ['socket' => 'AM5', 'cores' => 6, 'threads' => 12, 'base_clock' => '3.8 GHz', 'boost_clock' => '5.1 GHz', 'tdp' => '65 W', 'wattage' => 65, 'igpu' => true]],
                ['name' => 'AMD Ryzen 7 7800X3D', 'price' => 399, 'specs' => ['socket' => 'AM5', 'cores' => 8, 'threads' => 16, 'base_clock' => '4.2 GHz', 'boost_clock' => '5.0 GHz', 'tdp' => '120 W', 'wattage' => 120, 'igpu' => true]],
                ['name' => 'AMD Ryzen 9 7950X', 'price' => 549, 'specs' => ['socket' => 'AM5', 'cores' => 16, 'threads' => 32, 'base_clock' => '4.5 GHz', 'boost_clock' => '5.7 GHz', 'tdp' => '170 W', 'wattage' => 170, 'igpu' => true]],
                ['name' => 'AMD Ryzen 5 5600', 'price' => 134, 'specs' => ['socket' => 'AM4', 'cores' => 6, 'threads' => 12, 'base_clock' => '3.5 GHz', 'boost_clock' => '4.4 GHz', 'tdp' => '65 W', 'wattage' => 65, 'igpu' => false]],
                ['name' => 'AMD Ryzen 7 5800X3D', 'price' => 299, 'specs' => ['socket' => 'AM4', 'cores' => 8, 'threads' => 16, 'base_clock' => '3.4 GHz', 'boost_clock' => '4.5 GHz', 'tdp' => '105 W', 'wattage' => 105, 'igpu' => false]],
                ['name' => 'Intel Core i5-14600K', 'price' => 299, 'specs' => ['socket' => 'LGA1700', 'cores' => 14, 'threads' => 20, 'base_clock' => '3.5 GHz', 'boost_clock' => '5.3 GHz', 'tdp' => '181 W', 'wattage' => 181, 'igpu' => true]],
                ['name' => 'Intel Core i7-14700K', 'price' => 399, 'specs' => ['socket' => 'LGA1700', 'cores' => 20, 'threads' => 28, 'base_clock' => '3.4 GHz', 'boost_clock' => '5.6 GHz', 'tdp' => '253 W', 'wattage' => 253, 'igpu' => true]],
                ['name' => 'Intel Core i9-14900K', 'price' => 579, 'specs' => ['socket' => 'LGA1700', 'cores' => 24, 'threads' => 32, 'base_clock' => '3.2 GHz', 'boost_clock' => '6.0 GHz', 'tdp' => '253 W', 'wattage' => 253, 'igpu' => true]],
            ],
            'mainboard' => [
                ['name' => 'ASUS ROG Strix X670E-E Gaming', 'price' => 449, 'specs' => ['socket' => 'AM5', 'chipset' => 'X670E', 'form_factor' => 'ATX', 'memory_type' => 'DDR5', 'memory_slots' => 4, 'memory_max' => 128, 'wattage' => 30]],
                ['name' => 'MSI MAG B650 Tomahawk WiFi', 'price' => 219, 'specs' => ['socket' => 'AM5', 'chipset' => 'B650', 'form_factor' => 'ATX', 'memory_type' => 'DDR5', 'memory_slots' => 4, 'memory_max' => 192, 'wattage' => 20]],
                ['name' => 'ASRock B650M Pro RS', 'price' => 139, 'specs' => ['socket' => 'AM5', 'chipset' => 'B650', 'form_factor' => 'mATX', 'memory_type' => 'DDR5', 'memory_slots' => 4, 'memory_max' => 128, 'wattage' => 15]],
                ['name' => 'Gigabyte B650I Aorus Ultra', 'price' => 199, 'specs' => ['socket' => 'AM5', 'chipset' => 'B650', 'form_factor' => 'ITX', 'memory_type' => 'DDR5', 'memory_slots' => 2, 'memory_max' => 64, 'wattage' => 20]],
                ['name' => 'MSI MAG Z790 Tomahawk WiFi', 'price' => 269, 'specs' => ['socket' => 'LGA1700', 'chipset' => 'Z790', 'form_factor' => 'ATX', 'memory_type' => 'DDR5', 'memory_slots' => 4, 'memory_max' => 192, 'wattage' => 25]],
                ['name' => 'ASUS TUF Gaming B760M-Plus WiFi', 'price' => 179, 'specs' => ['socket' => 'LGA1700', 'chipset' => 'B760', 'form_factor' => 'mATX', 'memory_type' => 'DDR5', 'memory_slots' => 4, 'memory_max' => 192, 'wattage' => 20]],
                ['name' => 'Gigabyte B550 Aorus Elite V2', 'price' => 129, 'specs' => ['socket' => 'AM4', 'chipset' => 'B550', 'form_factor' => 'ATX', 'memory_type' => 'DDR4', 'memory_slots' => 4, 'memory_max' => 128, 'wattage' => 20]],
                ['name' => 'MSI B550M Pro-VDH WiFi', 'price' => 99, 'specs' => ['socket' => 'AM4', 'chipset' => 'B550', 'form_factor' => 'mATX', 'memory_type' => 'DDR4', 'memory_slots' => 4, 'memory_max' => 128, 'wattage' => 15]],
            ],
            'ram' => [
                ['name' => 'G.Skill Trident Z5 32 GB (2x16)', 'price' => 119, 'specs' => ['type' => 'DDR5', 'capacity' => 32, 'sticks' => 2, 'speed' => '6000 MHz', 'wattage' => 5]],
                ['name' => 'Corsair Vengeance 64 GB (2x32)', 'price' => 189, 'specs' => ['type' => 'DDR5', 'capacity' => 64, 'sticks' => 2, 'speed' => '5600 MHz', 'wattage' => 8]],
                ['name' => 'Kingston Fury Beast 16 GB (1x16)', 'price' => 57, 'specs' => ['type' => 'DDR5', 'capacity' => 16, 'sticks' => 1, 'speed' => '5200 MHz', 'wattage' => 4]],
                ['name' => 'Corsair Vengeance LPX 32 GB (2x16)', 'price' => 79, 'specs' => ['type' => 'DDR4', 'capacity' => 32, 'sticks' => 2, 'speed' => '3600 MHz', 'wattage' => 5]],
                ['name' => 'G.Skill Ripjaws V 64 GB (2x32)', 'price' => 119, 'specs' => ['type' => 'DDR4', 'capacity' => 64, 'sticks' => 2, 'speed' => '3200 MHz', 'wattage' => 8]],
            ],
            'gpu' => [
                ['name' => 'NVIDIA GeForce RTX 4060', 'price' => 299, 'specs' => ['chipset' => 'NVIDIA', 'vram' => 8, 'length_mm' => 244, 'wattage' => 115, 'recommended_psu' => 550]],
                ['name' => 'NVIDIA GeForce RTX 4070 Super', 'price' => 599, 'specs' => ['chipset' => 'NVIDIA', 'vram' => 12, 'length_mm' => 267, 'wattage' => 220, 'recommended_psu' => 650]],
                ['name' => 'NVIDIA GeForce RTX 4080 Super', 'price' => 1049, 'specs' => ['chipset' => 'NVIDIA', 'vram' => 16, 'length_mm' => 304, 'wattage' => 320, 'recommended_psu' => 750]],
                ['name' => 'NVIDIA GeForce RTX 4090', 'price' => 1699, 'specs' => ['chipset' => 'NVIDIA', 'vram' => 24, 'length_mm' => 336, 'wattage' => 450, 'recommended_psu' => 850]],
                ['name' => 'AMD Radeon RX 7800 XT', 'price' => 479, 'specs' => ['chipset' => 'AMD', 'vram' => 16, 'length_mm' => 267, 'wattage' => 263, 'recommended_psu' => 700]],
                ['name' => 'AMD Radeon RX 7900 XTX', 'price' => 949, 'specs' => ['chipset' => 'AMD', 'vram' => 24, 'length_mm' => 287, 'wattage' => 355, 'recommended_psu' => 800]],
            ],
            'netzteil' => [
                ['name' => 'be quiet! Pure Power 12 M 550W', 'price' => 89, 'specs' => ['wattage' => 550, 'efficiency' => '80+ Gold', 'modular' => true]],
                ['name' => 'Corsair RM650x 650W', 'price' => 109, 'specs' => ['wattage' => 650, 'efficiency' => '80+ Gold', 'modular' => true]],
                ['name' => 'Seasonic Focus GX-750 750W', 'price' => 129, 'specs' => ['wattage' => 750, 'efficiency' => '80+ Gold', 'modular' => true]],
                ['name' => 'be quiet! Straight Power 11 850W', 'price' => 159, 'specs' => ['wattage' => 850, 'efficiency' => '80+ Platinum', 'modular' => true]],
                ['name' => 'Corsair HX1000i 1000W', 'price' => 179, 'specs' => ['wattage' => 1000, 'efficiency' => '80+ Platinum', 'modular' => true]],
                ['name' => 'Super Flower Leadex V 1200W', 'price' => 199, 'specs' => ['wattage' => 1200, 'efficiency' => '80+ Titanium', 'modular' => true]],
            ],
            'ssd' => [
                ['name' => 'Samsung 990 Pro 1TB', 'price' => 109, 'specs' => ['capacity_gb' => 1000, 'interface' => 'NVMe', 'form_factor' => 'M.2', 'wattage' => 6]],
                ['name' => 'Samsung 990 Pro 2TB', 'price' => 189, 'specs' => ['capacity_gb' => 2000, 'interface' => 'NVMe', 'form_factor' => 'M.2', 'wattage' => 7]],
                ['name' => 'WD Black SN850X 2TB', 'price' => 159, 'specs' => ['capacity_gb' => 2000, 'interface' => 'NVMe', 'form_factor' => 'M.2', 'wattage' => 8]],
                ['name' => 'Crucial P3 Plus 1TB', 'price' => 74, 'specs' => ['capacity_gb' => 1000, 'interface' => 'NVMe', 'form_factor' => 'M.2', 'wattage' => 5]],
                ['name' => 'Kingston A400 480GB', 'price' => 39, 'specs' => ['capacity_gb' => 480, 'interface' => 'SATA', 'form_factor' => '2.5 Zoll', 'wattage' => 3]],
            ],
            'gehaeuse' => [
                ['name' => 'Fractal Design Meshify 2', 'price' => 159, 'specs' => ['form_factor' => 'ATX', 'max_psu_length' => 250, 'max_gpu_length' => 467, 'drive_bays' => 6]],
                ['name' => 'NZXT H5 Flow (2024)', 'price' => 99, 'specs' => ['form_factor' => 'ATX', 'max_psu_length' => 200, 'max_gpu_length' => 365, 'drive_bays' => 2]],
                ['name' => 'Lian Li O11 Dynamic Evo', 'price' => 139, 'specs' => ['form_factor' => 'ATX', 'max_psu_length' => 255, 'max_gpu_length' => 428, 'drive_bays' => 6]],
                ['name' => 'Fractal Design Define 7', 'price' => 179, 'specs' => ['form_factor' => 'ATX', 'max_psu_length' => 300, 'max_gpu_length' => 491, 'drive_bays' => 6]],
                ['name' => 'Cooler Master NR200', 'price' => 79, 'specs' => ['form_factor' => 'ITX', 'max_psu_length' => 130, 'max_gpu_length' => 330, 'drive_bays' => 2]],
            ],
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->products() as $categorySlug => $products) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();

            foreach ($products as $product) {
                Product::updateOrCreate(
                    ['category_id' => $category->id, 'name' => $product['name']],
                    $product
                );
            }
        }
    }
}
