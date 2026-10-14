<?php

namespace Tests\Feature;

use App\Models\Obat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_kasir_can_create_sale_and_stock_is_deducted(): void
    {
        $user = User::factory()->role('kasir')->create();
        $obat = Obat::query()->create([
            'code' => 'OBT-001',
            'name' => 'Paracetamol',
            'unit' => 'strip',
            'purchase_price' => 5000,
            'selling_price' => 7000,
            'stock' => 20,
            'minimum_stock' => 5,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->postJson('/api/sales', [
            'paid_amount' => 20000,
            'items' => [
                [
                    'obat_id' => $obat->id,
                    'quantity' => 2,
                ],
            ],
        ]);

        $response->assertCreated()
            ->assertJsonPath('total_amount', '14000.00')
            ->assertJsonPath('change_amount', '6000.00');

        $this->assertDatabaseHas('obats', [
            'id' => $obat->id,
            'stock' => 18,
        ]);

        $this->assertDatabaseHas('stock_movements', [
            'obat_id' => $obat->id,
            'type' => 'out',
            'quantity' => 2,
            'before_stock' => 20,
            'after_stock' => 18,
        ]);
    }

    public function test_kasir_cannot_manage_obat_data(): void
    {
        $user = User::factory()->role('kasir')->create();

        $response = $this->actingAs($user)->postJson('/api/obats', [
            'code' => 'OBT-002',
            'name' => 'Amoxicillin',
            'unit' => 'strip',
            'purchase_price' => 8000,
            'selling_price' => 10000,
        ]);

        $response->assertForbidden();
    }

    public function test_apoteker_can_update_stock_manually(): void
    {
        $user = User::factory()->role('apoteker')->create();
        $obat = Obat::query()->create([
            'code' => 'OBT-003',
            'name' => 'Vitamin C',
            'unit' => 'botol',
            'purchase_price' => 12000,
            'selling_price' => 15000,
            'stock' => 10,
            'minimum_stock' => 2,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->patchJson("/api/obats/{$obat->id}/stock", [
            'type' => 'in',
            'quantity' => 5,
            'notes' => 'Restock dari supplier',
        ]);

        $response->assertOk()->assertJsonPath('stock', 15);

        $this->assertDatabaseHas('stock_movements', [
            'obat_id' => $obat->id,
            'type' => 'in',
            'quantity' => 5,
            'before_stock' => 10,
            'after_stock' => 15,
        ]);
    }
}
