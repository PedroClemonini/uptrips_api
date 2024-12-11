<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripPackage extends Model
{
    use HasFactory;

    // Define o nome da tabela, caso a tabela não siga a convenção do plural
    protected $table = 'trip_package';

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'description',
        'image1_path',
        'image2_path',
        'image3_path',
        'image4_path',
        'image5_path',
        'image6_path',
        'image7_path',
        'start_date',
        'end_date',
        'status',
        'child_value',
        'adult_value',
        'destination_id',
        'hosting_id',
    ];

    // Relacionamento com a tabela 'destination' (um pacote de viagem pertence a um destino)
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    // Relacionamento com a tabela 'hosting' (um pacote de viagem pertence a um hosting)
    public function hosting()
    {
        return $this->belongsTo(Hosting::class);
    }
}

