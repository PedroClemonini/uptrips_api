<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourRequest extends FormRequest
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
            'description' => 'nullable|string|max:1000',
            'company' => 'nullable|string|max:255',
            'document' => 'nullable|string|max:50',
            'maintainer_phone' => 'nullable|string|max:20|regex:/^[0-9+\-\(\) ]+$/',
            'maintainer_email' => 'nullable|email|max:255',
            'image1_path' => 'nullable|string|max:255',
            'image2_path' => 'nullable|string|max:255',
            'image3_path' => 'nullable|string|max:255',
            'image4_path' => 'nullable|string|max:255',
            'image5_path' => 'nullable|string|max:255',
            'image6_path' => 'nullable|string|max:255',
            'image7_path' => 'nullable|string|max:255',
            'child_value' => 'nullable|numeric|min:0',
            'adult_value' => 'nullable|numeric|min:0',
            'destination_id' => 'required|integer|exists:destination,id',
        ];
    }
}
