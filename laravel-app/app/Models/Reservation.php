<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Define o nome da tabela, caso a tabela não siga a convenção do plural
    protected $table = 'reservation';

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'childs',
        'adults',
        'price',
        'status',
        'payment_date',
        'trip_package_id',
        'user_id',
    ];

    // Relacionamento com a tabela 'trip_package' (uma reserva pertence a um pacote de viagem)
    public function tripPackage()
    {
        return $this->belongsTo(TripPackage::class);
    }

    // Relacionamento com a tabela 'user' (uma reserva pertence a um usuário)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

