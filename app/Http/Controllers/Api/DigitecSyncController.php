<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\DigitecSyncService;
use Illuminate\Http\JsonResponse;

class DigitecSyncController extends Controller
{
    /**
     * POST /api/digitec/sync/{product}
     *
     * Synchronise a single product with Digitec (fix link, update price, or delete).
     */
    public function sync(Product $product, DigitecSyncService $service): JsonResponse
    {
        $result = $service->syncProduct($product);

        $statusCode = match ($result['status']) {
            'updated' => 200,
            'deleted' => 200,
            default => 422,
        };

        return response()->json($result, $statusCode);
    }

    /**
     * POST /api/digitec/sync-all
     *
     * Synchronise all products with Digitec sequentially.
     */
    public function syncAll(DigitecSyncService $service): JsonResponse
    {
        $results = $service->syncAll();

        return response()->json([
            'message' => sprintf(
                'Synchronisation abgeschlossen: %d aktualisiert, %d gelöscht, %d Fehler.',
                $results['updated'],
                $results['deleted'],
                $results['errors'],
            ),
            'summary' => [
                'updated' => $results['updated'],
                'deleted' => $results['deleted'],
                'errors' => $results['errors'],
            ],
            'details' => $results['details'],
        ]);
    }
}
