<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Obat;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StockMovement;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function index(): JsonResponse
    {
        $sales = Sale::query()
            ->with(['user', 'items.obat'])
            ->latest('sold_at')
            ->get();

        return response()->json($sales);
    }

    public function show(Sale $sale): JsonResponse
    {
        return response()->json($sale->load(['user', 'items.obat']));
    }

    public function store(StoreSaleRequest $request): JsonResponse
    {
        $sale = DB::transaction(function () use ($request): Sale {
            $sale = Sale::create([
                'invoice_number' => 'INV-'.now()->format('YmdHisv'),
                'user_id' => $request->user()->id,
                'sold_at' => $request->date('sold_at', now()),
                'notes' => $request->validated('notes'),
                'total_amount' => 0,
                'paid_amount' => 0,
                'change_amount' => 0,
            ]);

            $total = 0;

            foreach ($request->validated('items') as $item) {
                $obat = Obat::query()->lockForUpdate()->findOrFail($item['obat_id']);
                $quantity = (int) $item['quantity'];

                if ($obat->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'items' => "Stok {$obat->name} tidak cukup.",
                    ]);
                }

                $unitPrice = (float) ($item['unit_price'] ?? $obat->selling_price);
                $subtotal = $unitPrice * $quantity;
                $beforeStock = $obat->stock;
                $afterStock = $beforeStock - $quantity;

                $obat->update(['stock' => $afterStock]);

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'obat_id' => $obat->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $subtotal,
                ]);

                StockMovement::create([
                    'obat_id' => $obat->id,
                    'user_id' => $request->user()->id,
                    'type' => 'out',
                    'quantity' => $quantity,
                    'before_stock' => $beforeStock,
                    'after_stock' => $afterStock,
                    'reference_type' => 'sale',
                    'reference_id' => $sale->id,
                    'moved_at' => now(),
                ]);

                $total += $subtotal;
            }

            $paidAmount = (float) $request->validated('paid_amount', $total);

            if ($paidAmount < $total) {
                throw ValidationException::withMessages([
                    'paid_amount' => 'Nominal bayar tidak boleh kurang dari total.',
                ]);
            }

            $sale->update([
                'total_amount' => $total,
                'paid_amount' => $paidAmount,
                'change_amount' => $paidAmount - $total,
            ]);

            return $sale->fresh(['user', 'items.obat']);
        });

        return response()->json($sale, 201);
    }
}
