<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Corporate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('corporate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('municipio_id');
            $table->unsignedBigInteger('posto_id');
            $table->unsignedBigInteger('suco_id');
            $table->unsignedBigInteger('aldeia_id');
            $table->unsignedBigInteger('commactivity_auth_id');
            $table->string('company',100);
            $table->string('number',255);
            $table->string('address',255);
            $table->text('noted',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corporate');
    }
}
