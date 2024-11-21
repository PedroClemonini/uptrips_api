<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'title',
        'feedbackNotes',
        'description',
        'date',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
