<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'show_logo',
        'company_name',
        'address',
        'shipping_address',
        'telephone',
        'npwp',
        'website',
        'email',
        'account_bank',
    ];
}
