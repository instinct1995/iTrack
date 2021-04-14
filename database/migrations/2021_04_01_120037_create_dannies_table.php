<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dannies', function (Blueprint $table) {
            $table->id();
            $table->string("city");
            $table->integer("dohod");
            $table->integer("rashod");
            $table->integer("kol");
        });
        DB::unprepared('CREATE PROCEDURE GetRatingKol() BEGIN SET @position = 0; SET @prevPlace = 0; SELECT a.* FROM (SELECT id, if(@prevPlace != kol, @position := @position + 1, @position) as position, @prevPlace := kol FROM dannies ORDER BY kol desc) as a inner join dannies d on d.id=a.id WHERE a.id = d.id; END');
        DB::unprepared('CREATE PROCEDURE GetRatingDohod() BEGIN SET @position = 0; SET @prevPlace = 0; SELECT a.* FROM (SELECT id, if(@prevPlace != dohod, @position := @position + 1, @position) as position, @prevPlace := dohod FROM dannies ORDER BY dohod desc) as a inner join dannies d on d.id=a.id WHERE a.id = d.id; END');
        DB::unprepared('CREATE PROCEDURE GetRatingRashod() BEGIN SET @position = 0; SET @prevPlace = 0; SELECT a.* FROM (SELECT id, if(@prevPlace != rashod, @position := @position + 1, @position) as position, @prevPlace := rashod FROM dannies ORDER BY rashod desc) as a inner join dannies d on d.id=a.id WHERE a.id = d.id; END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dannies');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetRatingKol');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetRatingDohod');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetRatingRashod');
    }
}