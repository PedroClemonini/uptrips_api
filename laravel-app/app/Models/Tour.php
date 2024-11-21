<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'tour';

    protected $fillable = [
        'tourName',
        'description',
        'duration',
        'price',
        'availableDate',
        'reservationId'
    ];

    public function reservation(){
        return $this->belongsTo(Reservations::class);
    }

    use HasFactory;
}
