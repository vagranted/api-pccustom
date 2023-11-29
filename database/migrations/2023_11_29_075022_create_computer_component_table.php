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
        Schema::create('computer_component', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('computer_id');
            $table->unsignedTinyInteger('component_id');

            $table->foreign('computer_id')
                ->references('id')
                ->on('computers')
                ->onDelete('cascade');

            $table->foreign('component_id')
                ->references('id')
                ->on('components')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computer_component');
    }
};
