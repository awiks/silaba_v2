<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account_list extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'lists_code',
        'lists_name',
    ];


    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';


    public function account_category():BelongsTo
    {
        return $this->belongsTo(Account_category::class,'category_id','id');
    }
}
