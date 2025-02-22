<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->integer('console_id');
            $table->string('customer_name', 100)->nullable();
            $table->integer('timer');
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->string('status', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
