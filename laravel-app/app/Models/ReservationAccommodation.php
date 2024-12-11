<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationAccommodation extends Model
{
    use HasFactory;

    // Define o nome da tabela
    protected $table = 'reservationAccommodation';

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'accommodation_price',
        'reservation_id',
        'accommodation_id',
    ];

    // Relacionamento com a tabela 'reservation' (uma reserva tem muitos relacionamentos com acomodações)
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // Relacionamento com a tabela 'accommodation' (uma acomodação pode estar relacionada a várias reservas)
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}

