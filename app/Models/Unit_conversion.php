<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit_conversion extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'item_id',
        'unit_id',
        'amount',
        'unit_type',
        'buy_price',
        'sell_price',
    ];


    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';


    public function unit():BelongsTo
    {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }
}
