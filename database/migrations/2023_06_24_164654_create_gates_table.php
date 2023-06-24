<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatesTable extends Migration
{

    public function up()
    {
        Schema::create('gate', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->string('mapel');
            $table->date('tgl');
            $table->string('status');
            $table->time('open');
            $table->time('close');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gates');
    }
}
