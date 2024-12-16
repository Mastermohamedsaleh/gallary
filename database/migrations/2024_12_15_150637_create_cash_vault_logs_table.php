<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_vault_logs', function (Blueprint $table) {
            $table->id(); // عمود المفتاح الأساسي // نوع العملية
            $table->decimal('amount', 10, 2); // قيمة المبلغ الذي تمت إضافته أو سحبه
            $table->timestamps(); // أعمدة created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_vault_logs');
    }
};
