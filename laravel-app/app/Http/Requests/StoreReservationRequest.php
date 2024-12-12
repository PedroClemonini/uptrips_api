<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
        'childs' => 'required|integer',
        'adults' => 'required|integer',
        'trip_package_id' => 'required|exists:trip_package,id',
        'user_id' => 'required|exists:users,id',
        'accommodations' => 'array',
        'accommodations.*.id' => 'nullable|integer|exists:accommodation,id',
        'accommodations.*.accommodation_price' => 'required|numeric',
        'passengers' => 'array',
        'passengers.*.name' => 'required|string',
        'passengers.*.rg' => 'nullable|string',
        'passengers.*.cpf' => 'required|string',
        'passengers.*.age' => 'required|integer',
        'tours' => 'array',
        'tours.*.id' => 'nullable|integer|exists:tour,id',
        'tours.*.quantity_child' => 'required|integer',
        'tours.*.quantity_adult' => 'required|integer',
        ];
    }
}

