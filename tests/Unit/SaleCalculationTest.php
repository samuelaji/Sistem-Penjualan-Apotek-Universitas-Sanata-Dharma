<?php

namespace Tests\Unit;

use App\Models\Obat;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleCalculationTest extends TestCase
{
    use RefreshDatabase;

    public function test_recalculate_total_updates_sale_total_amount(): void
    {
        $user = User::factory()->create();
        $obat = Obat::query()->create([
            'code' => 'OBT-UNIT-001',
            'name' => 'Dummy Obat',
            'unit' => 'strip',
            'purchase_price' => 1000,
            'selling_price' => 2000,
            'stock' => 100,
            'minimum_stock' => 1,
            'is_active' => true,
        ]);

        $sale = Sale::query()->create([
            'invoice_number' => 'INV-UNIT-001',
            'user_id' => $user->id,
            'sold_at' => now(),
            'total_amount' => 0,
            'paid_amount' => 0,
            'change_amount' => 0,
        ]);

        SaleItem::query()->create([
            'sale_id' => $sale->id,
            'obat_id' => $obat->id,
            'quantity' => 1,
            'unit_price' => 10000,
            'subtotal' => 10000,
        ]);

        SaleItem::query()->create([
            'sale_id' => $sale->id,
            'obat_id' => $obat->id,
            'quantity' => 2,
            'unit_price' => 5000,
            'subtotal' => 10000,
        ]);

        $sale->recalculateTotal();

        $this->assertSame('20000.00', $sale->fresh()->total_amount);
    }
}
