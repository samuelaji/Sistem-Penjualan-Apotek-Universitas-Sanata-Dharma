<?php

namespace App\Http\Requests;

use App\Models\Obat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateObatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        /** @var Obat $obat */
        $obat = $this->route('obat');

        return [
            'code' => ['sometimes', 'required', 'string', 'max:50', Rule::unique('obats', 'code')->ignore($obat)],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'unit' => ['sometimes', 'required', 'string', 'max:50'],
            'purchase_price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'selling_price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'stock' => ['sometimes', 'required', 'integer', 'min:0'],
            'minimum_stock' => ['sometimes', 'required', 'integer', 'min:0'],
            'expired_at' => ['nullable', 'date'],
            'is_active' => ['sometimes', Rule::in([true, false, 0, 1, '0', '1'])],
        ];
    }
}
