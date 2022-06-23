<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMatkulIdToTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->foreignId('matkul_id')->after('dosen_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropForeign(['matkul_id']);
            $table->dropColumn('matkul_id');
        });
    }
}
