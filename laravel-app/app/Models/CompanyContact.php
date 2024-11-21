<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    protected $table = 'company_contact';

    protected $fillable = [
        'companyName',
        'cpnj',
        'phone',
        'phoneSecondary',
        'email',
        'emailSupport',
        'address',
        'cep',
        'openingHours',
        'linkFacebook',
        'linkInstagram',
        'linkWhatsapp',
        'logoUrl'
    ];

    use HasFactory;
}
