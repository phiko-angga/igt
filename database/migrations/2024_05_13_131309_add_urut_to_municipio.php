<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrutToMunicipio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('municipio', function (Blueprint $table) {
            $table->string('kode');
            $table->integer('urut')->default(1);
        });

        Schema::table('posto', function (Blueprint $table) {
            $table->string('kode');
            $table->integer('urut')->default(1);
        });

        Schema::table('suco', function (Blueprint $table) {
            $table->string('kode');
            $table->integer('urut')->default(1);
        });

        Schema::table('aldeia', function (Blueprint $table) {
            $table->string('kode');
            $table->integer('urut')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('municipio', function (Blueprint $table) {
            //
        });
    }
}
