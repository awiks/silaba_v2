<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account_category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sub_header_id',
        'category_code',
        'categories_name',
    ];


    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    public function account_sub_header():BelongsTo
    {
        return $this->belongsTo(Account_sub_header::class,'sub_header_id','id');
    }
}
