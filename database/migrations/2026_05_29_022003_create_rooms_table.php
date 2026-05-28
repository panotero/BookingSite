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
        Schema::create('rooms_table', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hotel_id')
                ->constrained('hotels_table')
                ->cascadeOnDelete();

            $table->string('room_name');
            $table->text('description')->nullable();
            $table->json('photos')->nullable();
            $table->integer('guest_capacity');
            $table->integer('bed_count');
            $table->string('room_area');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms_table');
    }
};
