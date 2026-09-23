<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class CompatibilityService
{
    private const FORM_FACTOR_ORDER = ['ITX' => 0, 'mATX' => 1, 'ATX' => 2];

    /**
     * Validate a set of products and report compatibility issues.
     *
     * @param  Collection<int, Product>  $products
     * @return array{compatible: bool, issues: array<int, string>, wattage_used: int, wattage_capacity: int}
     */
    public function validate(Collection $products): array
    {
        $issues = [];

        $cpu = $this->firstOfCategory($products, 'cpu');
        $mainboard = $this->firstOfCategory($products, 'mainboard');
        $ram = $this->firstOfCategory($products, 'ram');
        $gpu = $this->firstOfCategory($products, 'gpu');
        $psu = $this->firstOfCategory($products, 'netzteil');
        $case = $this->firstOfCategory($products, 'gehaeuse');

        if ($cpu !== null && $mainboard !== null) {
            $this->checkSocket($cpu, $mainboard, $issues);
        }

        if ($ram !== null && $mainboard !== null) {
            $this->checkRam($ram, $mainboard, $issues);
        }

        if ($mainboard !== null && $case !== null) {
            $this->checkFormFactor($mainboard, $case, $issues);
        }

        if ($gpu !== null && $case !== null) {
            $this->checkGpuLength($gpu, $case, $issues);
        }

        $wattageUsed = (int) $products->sum(fn (Product $product): int => $product->category->slug !== 'netzteil' ? $product->wattage : 0);
        $wattageCapacity = $psu !== null ? $psu->wattage : 0;

        if ($psu !== null && $wattageUsed > $wattageCapacity) {
            $issues[] = 'Netzteil zu schwach: Der PC benötigt mindestens '.$wattageUsed.' W, das gewählte Netzteil bietet nur '.$wattageCapacity.' W.';
        }

        return [
            'compatible' => $issues === [],
            'issues' => array_values($issues),
            'wattage_used' => $wattageUsed,
            'wattage_capacity' => $wattageCapacity,
        ];
    }

    /**
     * Check whether the current selection can be extended by a product.
     *
     * @param  Collection<int, Product>  $current
     * @return array{allowed: bool, replaced: bool, issues: array<int, string>, wattage_used: int, wattage_capacity: int}
     */
    public function checkAdd(Collection $current, Product $product): array
    {
        $replaced = $current->contains(
            fn (Product $p): bool => $p->category->slug === $product->category->slug
        );

        $candidate = $replaced
            ? $current->reject(fn (Product $p): bool => $p->category->slug === $product->category->slug)->push($product)
            : $current->concat([$product]);

        $result = $this->validate($candidate);

        return [
            'allowed' => $result['compatible'],
            'replaced' => $replaced,
            'issues' => $result['issues'],
            'wattage_used' => $result['wattage_used'],
            'wattage_capacity' => $result['wattage_capacity'],
        ];
    }

    /**
     * @param  Collection<int, Product>  $products
     */
    private function firstOfCategory(Collection $products, string $slug): ?Product
    {
        return $products->first(fn (Product $product): bool => $product->category->slug === $slug);
    }

    /**
     * @param  array<int, string>  $issues
     */
    private function checkSocket(Product $cpu, Product $mainboard, array &$issues): void
    {
        $cpuSocket = (string) ($cpu->specs['socket'] ?? '');
        $boardSocket = (string) ($mainboard->specs['socket'] ?? '');

        if ($cpuSocket !== '' && $cpuSocket !== $boardSocket) {
            $issues[] = 'Sockel-Konflikt: Der '.$cpu->name.' nutzt den Sockel '.$cpuSocket.', das Mainboard '.$mainboard->name.' aber den Sockel '.$boardSocket.'.';
        }
    }

    /**
     * @param  array<int, string>  $issues
     */
    private function checkRam(Product $ram, Product $mainboard, array &$issues): void
    {
        $ramType = (string) ($ram->specs['type'] ?? '');
        $boardType = (string) ($mainboard->specs['memory_type'] ?? '');

        if ($ramType !== '' && $ramType !== $boardType) {
            $issues[] = 'RAM-Konflikt: '.$ramType.'-Riegel passen nicht in ein '.$boardType.'-Mainboard.';
        }

        $ramSticks = (int) ($ram->specs['sticks'] ?? 0);
        $boardSlots = (int) ($mainboard->specs['memory_slots'] ?? 0);
        if ($ramSticks > $boardSlots || $boardSlots === 0) {
            $issues[] = 'RAM-Slots: Das Kit benötigt '.$ramSticks.' Steckplätze, das Mainboard bietet nur '.$boardSlots.'.';
        }

        $ramCapacity = (int) ($ram->specs['capacity'] ?? 0);
        $boardMax = (int) ($mainboard->specs['memory_max'] ?? 0);
        if ($boardMax > 0 && $ramCapacity > $boardMax) {
            $issues[] = 'RAM-Kapazität: '.$ramCapacity.' GB übersteigt das Maximum des Mainboards von '.$boardMax.' GB.';
        }
    }

    /**
     * @param  array<int, string>  $issues
     */
    private function checkFormFactor(Product $mainboard, Product $case, array &$issues): void
    {
        $boardOrder = $this->formFactorOrder($mainboard->specs['form_factor'] ?? '');
        $caseOrder = $this->formFactorOrder($case->specs['form_factor'] ?? '');

        if ($boardOrder > $caseOrder) {
            $boardFormFactor = $mainboard->specs['form_factor'];
            $caseFormFactor = $case->specs['form_factor'];
            $issues[] = 'Formfaktor: Ein '.$boardFormFactor.'-Mainboard passt nicht in ein '.$caseFormFactor.'-Gehäuse.';
        }
    }

    /**
     * @param  array<int, string>  $issues
     */
    private function checkGpuLength(Product $gpu, Product $case, array &$issues): void
    {
        $gpuLength = (int) ($gpu->specs['length_mm'] ?? 0);
        $maxLength = (int) ($case->specs['max_gpu_length'] ?? 0);

        if ($gpuLength > $maxLength && $maxLength > 0) {
            $issues[] = 'Grafikkarte zu lang: '.$gpuLength.' mm passen nicht in das Gehäuse (max. '.$maxLength.' mm).';
        }
    }

    private function formFactorOrder(mixed $formFactor): int
    {
        return self::FORM_FACTOR_ORDER[$formFactor] ?? -1;
    }
}
