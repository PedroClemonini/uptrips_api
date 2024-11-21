<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'tripDate',
        'startDate',
        'endDate',
        'totalPriceInCents',
        'status',
        'observations',
        'packageId',
        'customerId'
    ];

    public function packages(){
        return $this->belongsTo(Packages::class);
    }

    public function customer(){
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
