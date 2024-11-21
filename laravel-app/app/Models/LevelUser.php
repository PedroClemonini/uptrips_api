<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelUser extends Model
{
    protected $table = 'level_user';

    protected $fillable = [
        'userDescription'
    ];

    use HasFactory;
}
