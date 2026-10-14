<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStockRequest;
use App\Models\Obat;
use App\Models\StockMovement;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ObatStockController extends Controller
{
    public function update(UpdateStockRequest $request, Obat $obat): JsonResponse
    {
        $result = DB::transaction(function () use ($request, $obat): Obat {
            $lockedObat = Obat::query()->lockForUpdate()->findOrFail($obat->id);
            $beforeStock = $lockedObat->stock;
            $quantity = (int) $request->validated('quantity');

            if ($request->validated('type') === 'out') {
                if ($beforeStock < $quantity) {
                    throw ValidationException::withMessages([
                        'quantity' => 'Stok tidak cukup untuk dikurangi.',
                    ]);
                }

                $afterStock = $beforeStock - $quantity;
            } else {
                $afterStock = $beforeStock + $quantity;
            }

            $lockedObat->update(['stock' => $afterStock]);

            StockMovement::create([
                'obat_id' => $lockedObat->id,
                'user_id' => $request->user()?->id,
                'type' => $request->validated('type'),
                'quantity' => $quantity,
                'before_stock' => $beforeStock,
                'after_stock' => $afterStock,
                'notes' => $request->validated('notes'),
                'moved_at' => now(),
                'reference_type' => 'manual',
                'reference_id' => null,
            ]);

            return $lockedObat->fresh();
        });

        return response()->json($result);
    }
}
