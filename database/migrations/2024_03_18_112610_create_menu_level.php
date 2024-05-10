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
        Schema::create('menu_level', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('level_id');
            $table->timestamps();
        });
        
        DB::unprepared("insert into menu_level(level_id, menu_id) select 1, id from menu");
        DB::unprepared("insert into menu_level(level_id, menu_id) select 2, id from menu where id >= 5");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_level');
    }
};
