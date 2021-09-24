<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Ketika Dosen buat absen my expect:
            id:1
            dosen_id:1
            mahasiswa:null
            jadwal_id:3
            parent:0
            rangkuman:null
            berita_acara:null
            status:0
            pertemuan:null
        */
        /*
        Ketika Mahasiswa absen my expect:
            id:2
            dosen_id:0
            mahasiswa:3
            jadwal_id:3
            parent:0
            rangkuman:null
            berita_acara:null
            status:1
            pertemuan:null
        */
        Schema::create('absens', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('jadwal_id');
            $table->foreignId('dosen_id')->nullable();
            $table->foreignId('mahasiswa_id')->nullable();
            $table->boolean('parent')->default(0);
            $table->boolean('status')->nullable();
            $table->string('pertemuan')->nullable();
            $table->text('rangkuman')->nullable();
            $table->text('berita_acara')->nullable();
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
        Schema::dropIfExists('absens');
    }
}
