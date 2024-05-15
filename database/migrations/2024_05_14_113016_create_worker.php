<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('worker', function (Blueprint $table) {
            $table->string('id_type')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->string('id_number')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->unsignedBigInteger('corporate_id');
            $table->unsignedBigInteger('position_id');
            $table->string('code',10);
            $table->string('pob',100);
            $table->date('work_startdate');
            $table->string('work_period',50);
            $table->tinyInteger('c_university')->length(1)->default(0);
            $table->tinyInteger('c_institute')->length(1)->default(0);
            $table->tinyInteger('c_diploma')->length(1)->default(0);
            $table->tinyInteger('c_academy')->length(1)->default(0);
            $table->tinyInteger('c_senior_hs')->length(1)->default(0);
            $table->tinyInteger('c_junior_hs')->length(1)->default(0);
            $table->tinyInteger('c_good_behavior_letter')->length(1)->default(0);
            $table->tinyInteger('c_health_certificate')->length(1)->default(0);
            $table->tinyInteger('c_photo_3x4')->length(1)->default(0);
            $table->tinyInteger('c_diploma2')->length(1)->default(0);
            $table->tinyInteger('c_birth_certificate')->length(1)->default(0);
            $table->tinyInteger('c_identity_card')->length(1)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
