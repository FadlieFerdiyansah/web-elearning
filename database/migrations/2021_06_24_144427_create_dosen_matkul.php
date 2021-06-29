<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenMatkul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen_matkul', function (Blueprint $table) {
            $table->unsignedInteger('dosen_id')->constrained('dosens')->onDelete('cascade');
            $table->unsignedInteger('matkul_id');
            $table->primary(['dosen_id','matkul_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosen_matkul');
    }
}
