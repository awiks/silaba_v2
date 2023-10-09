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
        Schema::create('account_headers', function (Blueprint $table) {
            $table->id();
            $table->integer('header_code');
            $table->char('header_name',200);
            $table->enum('serving_header',['1', '2'])->comment('1=Neraca 2=Laba Rugi');
            $table->enum('normal_balance',['1', '2'])->comment('1=Debit 2=Kredit');
            $table->enum('addition',['1', '2'])->comment('1=Debit 2=Kredit');
            $table->enum('subtraction',['1', '2'])->comment('1=Debit 2=Kredit');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_headers');
    }
};
