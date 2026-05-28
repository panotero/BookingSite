<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_review', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hotel_id')
                ->constrained('hotels_table')
                ->cascadeOnDelete();

            $table->integer('rating');
            $table->text('review');
            $table->string('reviewer_name');
            $table->string('reviewer_email');
            $table->string('reviewer_contact');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_review');
    }
};
