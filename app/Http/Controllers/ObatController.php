<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObatRequest;
use App\Http\Requests\UpdateObatRequest;
use App\Models\Obat;
use Illuminate\Http\JsonResponse;

class ObatController extends Controller
{
    public function index(): JsonResponse
    {
        $obats = Obat::query()
            ->with(['category', 'supplier'])
            ->orderBy('name')
            ->get();

        return response()->json($obats);
    }

    public function store(StoreObatRequest $request): JsonResponse
    {
        $obat = Obat::create([
            ...$request->validated(),
            'stock' => $request->validated('stock', 0),
            'minimum_stock' => $request->validated('minimum_stock', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return response()->json($obat, 201);
    }

    public function show(Obat $obat): JsonResponse
    {
        return response()->json($obat->load(['category', 'supplier', 'stockMovements']));
    }

    public function update(UpdateObatRequest $request, Obat $obat): JsonResponse
    {
        $payload = $request->validated();

        if (array_key_exists('is_active', $payload)) {
            $payload['is_active'] = $request->boolean('is_active');
        }

        $obat->update($payload);

        return response()->json($obat->fresh(['category', 'supplier']));
    }

    public function destroy(Obat $obat): JsonResponse
    {
        $obat->delete();

        return response()->json(status: 204);
    }
}
