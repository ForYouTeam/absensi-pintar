<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('section'    );
            $table->string('tgl_gate'   );
            $table->string('open'       );
            $table->string('close'      );
            $table->string('nama_guru'  );
            $table->string('rfid_guru'  );
            $table->string('nama_siswa' );
            $table->string('rfid_siswa' );
            $table->string('kelas'      );
            $table->string('jurusan'    );
            $table->string('status'     );
            $table->string('tgl_absen'  );
            $table->string('start_tap'  );
            $table->string('end_tap'    );
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
        Schema::dropIfExists('logs');
    }
}
