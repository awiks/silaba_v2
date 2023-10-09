<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account_sub_header extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'header_id',
        'sub_header_code',
        'header_sub_name',
    ];


    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    public function account_header():BelongsTo
    {
        return $this->belongsTo(Account_header::class,'header_id','id');
    }
}
