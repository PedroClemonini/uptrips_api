<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $table = 'packages';

    protected $fillable = [
        'packageName',
        'description',
        'price',
        'startDate',
        'endDate',
        'maxPeople',
        'isActive',
        'trip_id'
    ];

    public function trips(){
        return $this->belongsTo(Trips::class);
    }

    protected static function boot(){
        parent::boot();

        static::creating(function ($package) {
            if (is_null($package->isActive)) {
                $package->isActive = true;
            }
        });
    }

    use HasFactory;
}
