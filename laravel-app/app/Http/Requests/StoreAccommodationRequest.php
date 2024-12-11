<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccommodationRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta solicitação.
     */
    public function authorize(): bool
    {
        return true; // Altere para verificar permissões, se necessário
    }

    /**
     * Regras de validação.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|Numeric',
            'hosting_id' => 'required|integer|exists:App\Models\Hosting,id',
        ];
    }
}

