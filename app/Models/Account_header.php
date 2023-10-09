<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account_header extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'header_code',
        'header_name',
        'serving_header',
        'normal_balance',
    ];


    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';
}