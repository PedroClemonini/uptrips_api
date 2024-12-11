<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTour extends Model
{
    use HasFactory;

    // Define o nome da tabela
    protected $table = 'reservationTour';

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'reservation_id',
        'tour_id',
        'tour_child_value',
        'tour_adult_value',
        'price',
    ];

    // Relacionamento com a tabela 'reservation' (um registro de reserva pertence a uma reserva)
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // Relacionamento com a tabela 'tour' (um registro de reserva pertence a um tour)
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}

