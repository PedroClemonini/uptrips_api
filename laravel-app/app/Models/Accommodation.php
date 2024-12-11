<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    // Define o nome da tabela, caso a tabela não siga a convenção do plural
    protected $table = 'accommodation';

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'name',
        'description',
        'price',
        'hosting_id',  // Chave estrangeira para a tabela 'hosting'
    ];

    // Relacionamento com a tabela 'hosting' (um alojamento pertence a um hosting)
    public function hosting()
    {
        return $this->belongsTo(Hosting::class);
    }
}

