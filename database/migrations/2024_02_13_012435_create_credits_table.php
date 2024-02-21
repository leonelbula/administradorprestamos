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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->float('amount',10,2);
            $table->float('utility',10,2);
            $table->float('balance',10,2);
            $table->integer('quota_number');
            $table->integer('quota_number_pendieng');
            $table->integer('interest');
            $table->date('date');
            $table->date('expiration_date');
            $table->integer('status');
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
