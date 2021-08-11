<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('kelas_id');
            $table->foreignId('dosen_id');
            $table->foreignId('mahasiswa_id')->default(0);
            $table->string('judul');
            $table->longText('file_or_link');
            $table->string('pertemuan');
            $table->text('deskripsi');
            $table->dateTime('mulai', 0);
            $table->dateTime('selesai', 0);
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
        Schema::dropIfExists('tugas');
    }
}
