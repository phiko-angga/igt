<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_level', function (Blueprint $table) {
            $table->id();
            $table->string('level',30);
            $table->timestamps();
        });
        
        DB::unprepared("insert into users_level(id,level) select 1,'Superadmin'");
        DB::unprepared("insert into users_level(id,level) select 2,'Administrator'");
        
        $pass = Hash::make('superadmin');
        $pass2 = Hash::make('administrator');
        DB::unprepared("insert into users(name,username,email,password,user_level) select 'Super Admin','superadmin','superadmin@bpe.com','".$pass."','1'");
        DB::unprepared("insert into users(name,username,email,password,user_level) select 'Administrator','administrator','administrator@bpe.com','".$pass2."','2'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_level');
    }
};
