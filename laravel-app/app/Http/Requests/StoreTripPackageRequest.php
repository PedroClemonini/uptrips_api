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
            'image1_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image2_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image3_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image4_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image5_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image6_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image7_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'child_value' => 'required|Numeric',
            'adult_value' => 'required|Numeric',
            'destination_id' => 'required|integer|exists:App\Models\Destination,id',
            'hosting_id' => 'required|integer|exists:App\Models\Hosting,id',
        ];
    }
}
