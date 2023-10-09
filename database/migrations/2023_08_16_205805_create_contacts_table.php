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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->char('nickname',50)->nullable();
            $table->json('contact_type');
            $table->char('contact_name',100)->nullable();
            $table->char('handphone',50)->nullable();
            $table->char('identity_type',10)->nullable();
            $table->char('identity_number',50)->nullable();
            $table->json('emails')->nullable()->unique();
            $table->char('other_info',225)->nullable();
            $table->char('company_name',150)->nullable();
            $table->char('telephone',50)->nullable();
            $table->char('fax',50)->nullable();
            $table->char('npwp',50)->nullable();
            $table->char('payment_address',225)->nullable();
            $table->char('shipping_address',225)->nullable();
            $table->bigInteger('receivable_account');
            $table->bigInteger('accounts_payable');
            $table->integer('receivable_checked')->length(1);
            $table->decimal('credit_limit', 15, 0);
            $table->integer('payable_checked')->length(1);
            $table->decimal('payable_limit', 15, 0);
            $table->char('profile',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
