<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfos extends Model
{
    protected $table = 'company_infos';

    protected $fillable = [
        'aboutCompany',
        'description'
    ];

    use HasFactory;
}
