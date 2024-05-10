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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('link',100);
            $table->tinyInteger('parent')->default(0);
            $table->string('name',100);
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('order')->default(1);
            $table->timestamps();
        });
        
        DB::unprepared("insert into menu(id, link, name, parent) select 1,'#','Setting',0");
        DB::unprepared("insert into menu(id, link, name, parent) select 2,'setting/user','User',1");
        DB::unprepared("insert into menu(id, link, name, parent) select 3,'setting/user-privilege','User Privilege',1");
        
        DB::unprepared("insert into menu(id, link, name, parent) select 4,'#','Data Master',1");
        DB::unprepared("insert into menu(id, link, name, parent) select 5,'master/municipio','Municipio',4");
        DB::unprepared("insert into menu(id, link, name, parent) select 6,'master/posto','Posto',4");
        DB::unprepared("insert into menu(id, link, name, parent) select 7,'master/suco','Suco',4");
        DB::unprepared("insert into menu(id, link, name, parent) select 8,'master/aldeia','Aldeia',4");
        DB::unprepared("insert into menu(id, link, name, parent) select 9,'master/comm-activity-auth','Commercial activity authorized',4");
        DB::unprepared("insert into menu(id, link, name, parent) select 10,'master/corporate','Corporate',4");
        DB::unprepared("insert into menu(id, link, name, parent) select 11,'master/position','Position',4");

        DB::unprepared("insert into menu(id, link, name, parent) select 12,'#','Transaction',0");
        DB::unprepared("insert into menu(id, link, name, parent) select 13,'transaction/local-foreign-worker','Local / Foreign Worker',12");
        DB::unprepared("insert into menu(id, link, name, parent) select 14,'transaction/supervision','Supervision',12");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
