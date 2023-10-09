<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank_account extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'contact_id',
        'bank_name',
        'branch_office',
        'account_holder',
        'account_number',
    ];


    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';
}
