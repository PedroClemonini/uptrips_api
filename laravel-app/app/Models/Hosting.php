<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hosting extends Model
{
    use HasFactory;

    protected $table = 'hosting';

    protected $fillable = [
        'name',
        'description',
        'contact_phone',
        'contact_email',
        'document',
        'address',
        'destination_id',
    ];

    protected $guarded = ['id'];

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class, 'hosting_id');

    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
