<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nickname',
        'contact_type',
        'contact_name',
        'handphone',
        'identity_type',
        'identity_number',
        'emails',
        'other_info',
        'company_name',
        'telephone',
        'fax',
        'npwp',
        'payment_address',
        'shipping_address',
        'account_bank',
        'receivable_account',
        'accounts_payable',
        'receivable_checked',
        'credit_limit',
        'payable_checked',
        'payable_limit',
        'profile',
    ];


    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';
}
