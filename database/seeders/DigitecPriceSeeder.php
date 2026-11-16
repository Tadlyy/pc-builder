<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DigitecPriceSeeder extends Seeder
{
    /**
     * Verified direct Digitec.ch product URLs (German /de/s1/product/) and prices (CHF).
     *
     * @return array<int, array{name: string, price: float, url: string, specs?: array<string, mixed>}>
     */
    public static function digitecData(): array
    {
        return [
            1 => [
                'name' => 'AMD Ryzen 5 7600',
                'price' => 146.00,
                'url' => 'https://www.digitec.ch/de/s1/product/amd-ryzen-5-7600-am5-380-ghz-6-core-prozessor-23246674',
            ],
            2 => [
                'name' => 'AMD Ryzen 7 7800X3D',
                'price' => 340.00,
                'url' => 'https://www.digitec.ch/de/s1/product/amd-ryzen-7-7800x3d-am5-420-ghz-8-core-prozessor-24667438',
            ],
            3 => [
                'name' => 'AMD Ryzen 9 7950X',
                'price' => 494.00,
                'url' => 'https://www.digitec.ch/de/s1/product/amd-ryzen-9-7950x-am5-450-ghz-16-core-prozessor-21918730',
            ],
            4 => [
                'name' => 'AMD Ryzen 5 5600',
                'price' => 116.00,
                'url' => 'https://www.digitec.ch/de/s1/product/amd-ryzen-5-5600-am4-350-ghz-6-core-prozessor-20147162',
            ],
            5 => [
                'name' => 'AMD Ryzen 7 5800X3D',
                'price' => 319.00,
                'url' => 'https://www.digitec.ch/de/s1/product/amd-ryzen-7-5800x3d-10th-anniversary-edition-am4-340-ghz-8-core-prozessor-71257527',
            ],
            6 => [
                'name' => 'Intel Core i5-14600K',
                'price' => 249.00,
                'url' => 'https://www.digitec.ch/de/s1/product/intel-core-i5-14600k-lga-1700-350-ghz-14-core-prozessor-38738121',
            ],
            7 => [
                'name' => 'Intel Core i7-14700K',
                'price' => 349.00,
                'url' => 'https://www.digitec.ch/de/s1/product/intel-core-i7-14700k-fclga1700-340-ghz-20-core-prozessor-43381783',
            ],
            8 => [
                'name' => 'Intel Core i9-14900K',
                'price' => 469.00,
                'url' => 'https://www.digitec.ch/de/s1/product/intel-core-i9-14900k-lga-1700-320-ghz-24-core-prozessor-38738117',
            ],
            9 => [
                'name' => 'ASUS ROG Strix X670E-E Gaming',
                'price' => 449.00,
                'url' => 'https://www.digitec.ch/de/s1/product/asus-rog-strix-x670e-e-gaming-wifi-am5-amd-x670e-atx-mainboard-22445220',
            ],
            10 => [
                'name' => 'MSI MAG B650 Tomahawk WiFi',
                'price' => 199.00,
                'url' => 'https://www.digitec.ch/de/s1/product/msi-mag-b650-tomahawk-wifi-am5-amd-b650-atx-mainboard-22670813',
            ],
            11 => [
                'name' => 'ASRock B650M Pro RS',
                'price' => 119.00,
                'url' => 'https://www.digitec.ch/de/s1/product/asrock-b650m-pro-rs-am5-amd-b650-matx-mainboard-35511148',
            ],
            12 => [
                'name' => 'Gigabyte B650I Aorus Ultra',
                'price' => 249.00,
                'url' => 'https://www.digitec.ch/de/s1/product/gigabyte-b650i-aorus-ultra-am5-amd-b650-mini-itx-mainboard-37094011',
            ],
            13 => [
                'name' => 'MSI MAG Z790 Tomahawk WiFi',
                'price' => 229.00,
                'url' => 'https://www.digitec.ch/de/s1/product/msi-mag-z790-tomahawk-wifi-lga-1700-intel-z790-atx-mainboard-22726088',
            ],
            14 => [
                'name' => 'ASUS TUF Gaming B760M-Plus WiFi',
                'price' => 169.00,
                'url' => 'https://www.digitec.ch/de/s1/product/asus-tuf-gaming-b760m-plus-wifi-lga-1700-intel-b760-matx-mainboard-25133933',
            ],
            15 => [
                'name' => 'Gigabyte B550 Aorus Elite V2',
                'price' => 119.00,
                'url' => 'https://www.digitec.ch/de/s1/product/gigabyte-b550-aorus-elite-v2-am4-amd-b550-atx-mainboard-13348748',
            ],
            16 => [
                'name' => 'MSI B550M Pro-VDH WiFi',
                'price' => 93.90,
                'url' => 'https://www.digitec.ch/de/s1/product/msi-b550m-pro-vdh-wifi-am4-amd-b550-matx-mainboard-13347416',
            ],
            17 => [
                'name' => 'G.Skill Trident Z5 32 GB (2x16)',
                'price' => 159.00,
                'url' => 'https://www.digitec.ch/de/s1/product/gskill-trident-z5-2-x-16gb-6400-mhz-ddr5-ram-dimm-ram-18761190',
            ],
            18 => [
                'name' => 'Corsair Vengeance 64 GB (2x32)',
                'price' => 219.00,
                'url' => 'https://www.digitec.ch/de/s1/product/corsair-vengeance-2-x-32gb-6000-mhz-ddr5-ram-dimm-ram-35769001',
            ],
            19 => [
                'name' => 'Kingston Fury Beast 16 GB (1x16)',
                'price' => 45.00,
                'url' => 'https://www.digitec.ch/de/s1/product/kingston-fury-beast-1-x-16gb-3200-mhz-ddr4-ram-dimm-ram-16234794',
            ],
            20 => [
                'name' => 'Corsair Vengeance LPX 32 GB (2x16)',
                'price' => 69.00,
                'url' => 'https://www.digitec.ch/de/s1/product/corsair-vengeance-lpx-2-x-16gb-3200-mhz-ddr4-ram-dimm-ram-11388204',
            ],
            21 => [
                'name' => 'G.Skill Ripjaws V 64 GB (2x32)',
                'price' => 129.00,
                'url' => 'https://www.digitec.ch/de/s1/product/gskill-ripjaws-v-2-x-32gb-3200-mhz-ddr4-ram-dimm-ram-12831621',
            ],
            22 => [
                'name' => 'NVIDIA GeForce RTX 4060',
                'price' => 313.00,
                'url' => 'https://www.digitec.ch/de/s1/product/gigabyte-geforce-rtx-4060-8gb-gaming-oc-8-gb-grafikkarte-36740425',
            ],
            23 => [
                'name' => 'NVIDIA GeForce RTX 4070 Super',
                'price' => 649.00,
                'url' => 'https://www.digitec.ch/de/s1/product/msi-geforce-rtx-4070-super-12g-gaming-x-slim-12-gb-grafikkarte-41236434',
            ],
            24 => [
                'name' => 'NVIDIA GeForce RTX 4080 Super',
                'price' => 1099.00,
                'url' => 'https://www.digitec.ch/de/s1/product/asus-rog-strix-geforce-rtx-4080-super-16-gb-grafikkarte-42617084',
            ],
            25 => [
                'name' => 'NVIDIA GeForce RTX 4090',
                'price' => 1899.00,
                'url' => 'https://www.digitec.ch/de/s1/product/asus-tuf-gaming-geforce-rtx-4090-og-oc-edition-24-gb-grafikkarte-35802570',
            ],
            26 => [
                'name' => 'AMD Radeon RX 7800 XT',
                'price' => 489.00,
                'url' => 'https://www.digitec.ch/de/s1/product/gigabyte-radeon-rx-7800-xt-gaming-oc-16-gb-grafikkarte-37860841',
            ],
            27 => [
                'name' => 'AMD Radeon RX 7900 XTX',
                'price' => 929.00,
                'url' => 'https://www.digitec.ch/de/s1/product/asrock-radeon-rx-7900-xtx-phantom-gaming-oc-24-gb-grafikkarte-23854118',
            ],
            28 => [
                'name' => 'be quiet! Pure Power 12 M 550W',
                'price' => 89.90,
                'url' => 'https://www.digitec.ch/de/s1/product/be-quiet-pure-power-12-m-550-w-pc-netzteil-24077999',
            ],
            29 => [
                'name' => 'Corsair RM650x 650W',
                'price' => 109.00,
                'url' => 'https://www.digitec.ch/de/s1/product/corsair-rm650x-650-w-pc-netzteil-15626044',
            ],
            30 => [
                'name' => 'Seasonic Focus GX-750 750W',
                'price' => 119.00,
                'url' => 'https://www.digitec.ch/de/s1/product/seasonic-focus-gx-750-750-w-pc-netzteil-48245478',
            ],
            31 => [
                'name' => 'be quiet! Straight Power 11 850W',
                'price' => 149.00,
                'url' => 'https://www.digitec.ch/de/s1/product/be-quiet-straight-power-11-gold-850-w-pc-netzteil-7478934',
            ],
            32 => [
                'name' => 'Corsair HX1000i 1000W',
                'price' => 214.00,
                'url' => 'https://www.digitec.ch/de/s1/product/corsair-hx1000i-1000-w-pc-netzteil-33003895',
            ],
            34 => [
                'name' => 'Samsung 990 Pro 1TB',
                'price' => 101.00,
                'url' => 'https://www.digitec.ch/de/s1/product/samsung-990-pro-1000-gb-m2-2280-ssd-22097720',
            ],
            35 => [
                'name' => 'Samsung 990 Pro 2TB',
                'price' => 154.00,
                'url' => 'https://www.digitec.ch/de/s1/product/samsung-990-pro-2000-gb-m2-2280-ssd-22097721',
            ],
            36 => [
                'name' => 'WD Black SN850X 2TB',
                'price' => 149.00,
                'url' => 'https://www.digitec.ch/de/s1/product/wd-black-sn850x-2000-gb-m2-2280-ssd-21635316',
            ],
            37 => [
                'name' => 'Crucial P3 Plus 1TB',
                'price' => 69.00,
                'url' => 'https://www.digitec.ch/de/s1/product/crucial-p3-plus-1000-gb-m2-2280-ssd-21575424',
            ],
            38 => [
                'name' => 'Kingston A400 480GB',
                'price' => 32.90,
                'url' => 'https://www.digitec.ch/de/s1/product/kingston-a400-480-gb-25-ssd-6305464',
            ],
            39 => [
                'name' => 'Fractal Design Meshify 2',
                'price' => 139.00,
                'url' => 'https://www.digitec.ch/de/s1/product/fractal-meshify-2-black-tg-light-atx-pc-gehaeuse-14097213',
            ],
            40 => [
                'name' => 'NZXT H5 Flow (2024)',
                'price' => 87.90,
                'url' => 'https://www.digitec.ch/de/s1/product/nzxt-h5-flow-2024-schwarz-tempered-glass-atx-mini-itx-matx-e-atx-pc-gehaeuse-47925081',
            ],
            41 => [
                'name' => 'Lian Li O11 Dynamic Evo',
                'price' => 149.00,
                'url' => 'https://www.digitec.ch/de/s1/product/lian-li-o11d-evo-atx-matx-mini-itx-pc-gehaeuse-41287108',
            ],
            42 => [
                'name' => 'Fractal Design Define 7',
                'price' => 169.00,
                'url' => 'https://www.digitec.ch/de/s1/product/fractal-define-7-black-tgd-atx-matx-mini-itx-e-atx-pc-gehaeuse-12757903',
            ],
            43 => [
                'name' => 'Cooler Master NR200',
                'price' => 79.90,
                'url' => 'https://www.digitec.ch/de/s1/product/cooler-master-masterbox-nr200-mini-dtx-mini-itx-pc-gehaeuse-15665512',
            ],
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = self::digitecData();

        // 1. Update all valid products with verified canonical Digitec URLs & prices
        foreach ($data as $id => $item) {
            $product = Product::find($id);

            if ($product === null) {
                continue;
            }

            $product->price = $item['price'];
            $product->url = $item['url'];

            if (isset($item['name'])) {
                $product->name = $item['name'];
            }

            if (isset($item['specs'])) {
                $product->specs = $item['specs'];
            }

            $product->save();
        }

        // 2. Remove products that do not exist on Digitec (e.g. ID 33)
        $product33 = Product::find(33);
        if ($product33 !== null) {
            $product33->builds()->detach();
            $product33->delete();
        }
    }
}
