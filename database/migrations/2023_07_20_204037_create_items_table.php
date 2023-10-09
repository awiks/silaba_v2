<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->char('code_sku',50)->unique();
            $table->char('barcode',50)->unique()->nullable();
            $table->bigInteger('brand_id');
            $table->bigInteger('category_id');
            $table->string('item_name',150);
            $table->string('description')->nullable();
            $table->integer('buy_checked')->length(1);
            $table->bigInteger('account_buy');
            $table->bigint('tax_buy_id')->nullable();
            $table->integer('sell_cheked')->length(1);
            $table->bigInteger('account_sell');
            $table->bigint('tax_sell_id')->nullable();
            $table->integer('inventory_checked')->length(1);
            $table->integer('minimum_stock')->nullable();
            $table->bigInteger('account_inventory');
            $table->char('images',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
