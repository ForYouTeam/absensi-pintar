<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->string('nama');
            $table->string('tmpt_lahir');
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->string('hp');
            $table->string('sex');
            $table->string('agama');
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->foreignId('jurusan_id')->constrained('jurusan');
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
        Schema::dropIfExists('siswas');
    }
}
