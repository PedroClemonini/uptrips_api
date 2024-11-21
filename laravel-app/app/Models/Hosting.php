<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Destination;

class Hosting extends Model
{
    use HasFactory;

    protected $table = 'hosting';

    protected $fillable = [
        'name',
        'type',
        'phone',
        'email',
        'price',
        'destination_id'
    ];
    public function destination(){
        return $this->belongsTo(Destination::class);
    }

}
