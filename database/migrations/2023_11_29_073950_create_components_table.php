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
        Schema::create('components', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->autoIncrement();
            $table->unsignedTinyInteger('component_type_id');
            $table->string('title', 64);
            $table->decimal('price');

            $table->foreign('component_type_id')
                ->references('id')
                ->on('component_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
