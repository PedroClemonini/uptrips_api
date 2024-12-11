<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    // Define o nome da tabela
    protected $table = 'destination';

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'name',
        'description',
        'city',
        'state',
    ];

    // Relacionamentos podem ser definidos aqui, se houver (por exemplo, com a tabela hosting)
}

