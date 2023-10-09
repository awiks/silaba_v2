<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code_sku',
        'barcode',
        'brand_id',
        'category_id',
        'item_name',
        'description',
        'buy_checked',
        'account_buy',
        'tax_buy_id',
        'sell_cheked',
        'account_sell',
        'tax_sell_id',
        'inventory_checked',
        'account_inventory',
        'minimum_stock',
        'images',
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    
    public function unit_conversion()
    {
        return $this->hasMany(Unit_conversion::class,'item_id','id');
    }
}
