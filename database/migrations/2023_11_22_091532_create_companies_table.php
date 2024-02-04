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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->integer('show_logo')->length(1);
            $table->string('company_name');
            $table->string('address');
            $table->string('shipping_address');
            $table->string('telephone');
            $table->string('fax');
            $table->string('npwp');
            $table->string('website');
            $table->string('email');
            $table->longText('account_bank');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
