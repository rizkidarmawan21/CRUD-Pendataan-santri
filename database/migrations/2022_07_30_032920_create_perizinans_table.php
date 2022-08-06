<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerizinansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perizinans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_santri');
            $table->string('nama_perizinan');
            $table->string('tanggal_perizinan');
            $table->string('keterangan');
            $table->date('tanggal_kembali');
            $table->string('status'); //  0 = belum diverifikasi, 1 = diverifikasi / masa izin, 2 = sudah dikembalikan
            $table->softDeletes();
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
        Schema::dropIfExists('perizinans');
    }
}
