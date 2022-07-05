<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen_kelas', function (Blueprint $table) {
            $table->unsignedInteger('dosen_id')->constrained('dosens')->onDelete('cascade');
            $table->unsignedInteger('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->unsignedInteger('matkul_id')->nullable();

            $table->primary(['dosen_id','kelas_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosen_kelas');
    }
}
