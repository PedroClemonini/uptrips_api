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
        'status' => 'string|in:awaiting_payment,payed,canceled',
        'payment_date' => 'nullable|date',
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
        'tours.*.tour_child_value' => 'required|numeric',
        'tours.*.tour_adult_value' => 'required|numeric',
        ];
    }
}

