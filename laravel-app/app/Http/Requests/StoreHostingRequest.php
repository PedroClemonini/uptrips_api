<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHostingRequest extends FormRequest
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
            'document' => 'required|string|max:14',
            'address' => 'required|string',
            'contact_phone' => 'required|string|max:14',
            'contact_email' => 'string',
            'destination_id' => 'required|integer|exists:App\Models\Destination,id',
        ];
    }
}

