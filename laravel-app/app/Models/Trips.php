<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trips extends Model
{
    protected $table = 'trips';

    protected $fillable = [
        'boardingPlace',
        'landingPlace',
        'numberReservation',
        'startDate',
        'endDate',
        'trasnportId'
    ];

    public function transport(){
        return $this->belongsTo(Transport::class);
    }

    use HasFactory;
}
