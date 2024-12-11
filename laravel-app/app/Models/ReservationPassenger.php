<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationPassenger extends Model
{
    use HasFactory;

    // Define o nome da tabela
    protected $table = 'reservationPassengers';

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'name',
        'rg',
        'cpf',
        'age',
        'reservation_price',
        'reservation_id',
    ];

    // Relacionamento com a tabela 'reservation' (um passageiro pertence a uma reserva)
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}

