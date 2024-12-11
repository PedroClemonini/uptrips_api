<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripPackageRequest extends FormRequest
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
            'image1_path' => 'required|string',
            'image2_path' => 'string',
            'image3_path' => 'string',
            'image4_path' => 'string',
            'image5_path' => 'string',
            'image6_path' => 'string',
            'image7_path' => 'string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'child_value' => 'required|Numeric',
            'adult_value' => 'required|Numeric',
            'destination_id' => 'required|integer|exists:App\Models\Destination,id',
            'hosting_id' => 'required|integer|exists:App\Models\Hosting,id',
        ];
    }
}
