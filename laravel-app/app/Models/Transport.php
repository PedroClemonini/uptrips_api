<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $table = 'transport';

    protected $fillable = [
        'type',
        'capacity',
        'transportCompany',
        'model',
        'licensePlate',
        'manufatureYear'
    ];

    use HasFactory;
}
