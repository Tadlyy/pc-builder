<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DigitecPriceSeeder extends Seeder
{
    /**
     * Digitec.ch prices (CHF) and product URLs, keyed by product id.
     *
     * @return array<int, array{price: float, url: string, name?: string, specs?: array<string, mixed>}>
     */
    private function digitecData(): array
    {
        return [
            1 => ['price' => 158.00, 'url' => 'https://www.digitec.ch/en/s1/product/amd-ryzen-5-7600-am5-380-ghz-6-core-processors-23246674'],
            2 => ['price' => 340.00, 'url' => 'https://www.digitec.ch/en/s1/product/amd-ryzen-7-7800x3d-am5-420-ghz-8-core-processors-49492163'],
            3 => ['price' => 494.00, 'url' => 'https://www.digitec.ch/en/s1/product/amd-ryzen-9-7950x-am5-450-ghz-16-core-processors-23246660'],
            4 => ['price' => 116.00, 'url' => 'https://www.digitec.ch/en/s1/product/amd-ryzen-5-5600-am4-360-ghz-6-core-processors-16888009'],
            5 => ['price' => 319.00, 'url' => 'https://www.digitec.ch/en/s1/product/amd-ryzen-7-5800x3d-am4-340-ghz-8-core-processors-20725394'],
            6 => ['price' => 190.00, 'url' => 'https://www.digitec.ch/en/s1/product/intel-core-i5-14600k-lga-1700-350-ghz-14-core-processors-22519756'],
            7 => ['price' => 309.00, 'url' => 'https://www.digitec.ch/en/s1/product/intel-core-i7-14700k-lga-1700-340-ghz-20-core-processors-22519758'],
            8 => ['price' => 410.00, 'url' => 'https://www.digitec.ch/en/s1/product/intel-core-i9-14900k-lga-1700-320-ghz-24-core-processors-22519759'],
            9 => ['price' => 469.00, 'url' => 'https://www.digitec.ch/en/s1/product/asus-rog-strix-x670e-e-gaming-wifi-am5-amd-x670e-atx-motherboards-23129871'],
            10 => ['price' => 142.00, 'url' => 'https://www.digitec.ch/en/s1/product/msi-mag-b650-tomahawk-wifi-am5-amd-b650-atx-motherboards-22670813'],
            11 => ['price' => 109.00, 'url' => 'https://www.digitec.ch/en/s1/product/asrock-b650m-pro-rs-am5-amd-b650m-matx-motherboards-25429217'],
            12 => ['price' => 189.00, 'url' => 'https://www.digitec.ch/en/s1/product/gigabyte-b650i-aorus-ultra-am5-amd-b650-mini-itx-motherboards-23129993'],
            13 => ['price' => 229.00, 'url' => 'https://www.digitec.ch/en/s1/product/msi-mag-z790-tomahawk-wifi-lga-1700-intel-z790-atx-motherboards-22726088'],
            14 => ['price' => 139.00, 'url' => 'https://www.digitec.ch/en/s1/product/asus-tuf-gaming-b760m-plus-wifi-lga-1700-intel-b760m-matx-motherboards-22761064'],
            15 => ['price' => 99.00, 'url' => 'https://www.digitec.ch/en/s1/product/gigabyte-b550-aorus-elite-v2-am4-amd-b550-atx-motherboards-16348652'],
            16 => ['price' => 89.00, 'url' => 'https://www.digitec.ch/en/s1/product/msi-b550m-pro-vdh-wifi-am4-amd-b550-matx-motherboards-13347416'],
            17 => ['price' => 159.00, 'url' => 'https://www.digitec.ch/en/s1/product/gskill-trident-z5-neo-6000-mhz-ddr5-ram-dimm-ram-22433061'],
            18 => ['price' => 219.00, 'url' => 'https://www.digitec.ch/en/s1/product/corsair-vengeance-6000-mhz-ddr5-ram-dimm-ram-24118520'],
            19 => ['price' => 59.00, 'url' => 'https://www.digitec.ch/en/s1/product/kingston-fury-beast-6000-mhz-ddr5-ram-dimm-ram-23702198'],
            20 => ['price' => 79.00, 'url' => 'https://www.digitec.ch/en/s1/product/corsair-vengeance-lpx-2-x-32gb-3200-mhz-ddr4-ram-dimm-ram-12091476'],
            21 => ['price' => 139.00, 'url' => 'https://www.digitec.ch/en/s1/product/gskill-ripjaws-v-2-x-32gb-3600-mhz-ddr4-ram-dimm-ram-13898925'],
            22 => ['price' => 313.00, 'url' => 'https://www.digitec.ch/de/s1/product/gigabyte-geforce-rtx-4060-8gb-gaming-oc-8-gb-grafikkarte-36740425'],
            23 => ['price' => 819.00, 'url' => 'https://www.digitec.ch/de/s1/product/msi-geforce-rtx-4070-super-gaming-x-slim-12-gb-grafikkarte-41236434'],
            24 => ['price' => 1289.00, 'url' => 'https://www.digitec.ch/de/s1/product/asus-rog-strix-geforce-rtx-4080-super-16-gb-grafikkarte-42617084'],
            25 => ['price' => 1607.00, 'url' => 'https://www.digitec.ch/de/s1/product/asus-tuf-gaming-geforce-rtx-4090-og-oc-edition-24-gb-grafikkarte-35802570'],
            26 => ['price' => 477.00, 'url' => 'https://www.digitec.ch/en/s1/product/gigabyte-radeon-rx-7800-xt-gaming-oc-16-gb-graphics-card-37860841'],
            27 => ['price' => 972.00, 'url' => 'https://www.digitec.ch/en/s1/product/asrock-radeon-rx-7900-xtx-phantom-gaming-oc-24-gb-graphics-card-23854118'],
            28 => ['price' => 98.90, 'url' => 'https://www.digitec.ch/en/s1/product/be-quiet-pure-power-12-m-550-w-power-supply-pc-24077999'],
            29 => ['price' => 110.00, 'url' => 'https://www.digitec.ch/en/s1/product/corsair-rm650x-650-w-power-supply-pc-15626044'],
            30 => ['price' => 119.00, 'url' => 'https://www.digitec.ch/en/s1/product/seasonic-focus-gx-750-750-w-power-supply-pc-48245478'],
            31 => ['price' => 149.00, 'url' => 'https://www.digitec.ch/en/s1/product/be-quiet-straight-power-11-gold-850-w-power-supply-pc-7478934'],
            32 => ['price' => 214.00, 'url' => 'https://www.digitec.ch/en/s1/product/corsair-hx1000i-1000-w-power-supply-pc-33003895'],
            33 => ['price' => 189.00, 'url' => 'https://www.digitec.ch/en/s1/product/super-flower-leadex-iii-gold-up-1300w-80-plus-gold-netzteil-pcie-51-atx-31-1300-watt-schwarz-130-w-p-53743358', 'name' => 'Super Flower Leadex III GOLD UP 1300W', 'specs' => ['wattage' => 1300, 'efficiency' => '80+ Gold', 'modular' => true]],
            34 => ['price' => 101.00, 'url' => 'https://www.digitec.ch/de/s1/product/samsung-990-pro-1000-gb-m2-2280-ssd-22097720'],
            35 => ['price' => 154.00, 'url' => 'https://www.digitec.ch/de/s1/product/samsung-990-pro-2000-gb-m2-2280-ssd-22097721'],
            36 => ['price' => 249.00, 'url' => 'https://www.digitec.ch/de/s1/product/wd-black-sn850x-2000-gb-m2-2280-ssd-21635316'],
            37 => ['price' => 109.00, 'url' => 'https://www.digitec.ch/de/s1/product/crucial-p3-plus-1000-gb-m2-2280-ssd-21575424'],
            38 => ['price' => 35.70, 'url' => 'https://www.digitec.ch/en/s1/product/kingston-a400-480-gb-25-ssd-6305464'],
            39 => ['price' => 129.00, 'url' => 'https://www.digitec.ch/de/s1/product/fractal-design-meshify-2-black-tg-light-atx-matx-mini-itx-e-atx-pc-case-12757905'],
            40 => ['price' => 87.90, 'url' => 'https://www.digitec.ch/en/s1/product/nzxt-h5-flow-2024-schwarz-tempered-glass-atx-mini-itx-matx-e-atx-pc-case-47925081'],
            41 => ['price' => 137.00, 'url' => 'https://www.digitec.ch/de/s1/product/lian-li-o11d-evo-atx-matx-mini-itx-pc-case-41287108'],
            42 => ['price' => 170.00, 'url' => 'https://www.digitec.ch/en/s1/product/fractal-define-7-black-tgd-atx-matx-mini-itx-e-atx-pc-case-12757903'],
            43 => ['price' => 99.00, 'url' => 'https://www.digitec.ch/en/s1/product/cooler-master-masterbox-nr200-mini-dtx-mini-itx-pc-case-15665512'],
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->digitecData() as $id => $data) {
            $product = Product::find($id);

            if ($product === null) {
                continue;
            }

            $product->price = $data['price'];
            $product->url = $data['url'];

            if (isset($data['name'])) {
                $product->name = $data['name'];
            }

            if (isset($data['specs'])) {
                $product->specs = $data['specs'];
            }

            $product->save();
        }
    }
}
