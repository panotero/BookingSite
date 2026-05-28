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
        Schema::create('price_table', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_id')
                ->constrained('rooms_table')
                ->cascadeOnDelete();

            $table->decimal('price', 10, 2);
            $table->decimal('discounted_price', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_table');
    }
};
