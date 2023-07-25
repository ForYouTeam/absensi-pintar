<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDaftarHadirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daftar_hadir', function (Blueprint $table) {
            $table->foreignId('gate_id')->after('id')->constrained('gate')->onDelete('cascade');
            $table->string('status')->after('siswa_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daftar_hadir', function (Blueprint $table) {

        });
    }
}
