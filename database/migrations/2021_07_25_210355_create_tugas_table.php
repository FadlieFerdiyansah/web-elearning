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
            $table->foreignId('jadwal_id');
            $table->foreignId('dosen_id')->nullable();
            $table->foreignId('mahasiswa_id')->nullable();
            $table->string('parent')->default(0);
            $table->string('judul')->nullable();
            $table->string('tipe');
            $table->string('file_or_link');
            $table->string('pertemuan');
            $table->text('deskripsi')->nullable();
            $table->dateTime('pengumpulan')->nullable();
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
