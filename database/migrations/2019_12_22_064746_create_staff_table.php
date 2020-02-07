<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->char('jenis_kelamin');
            $table->string('agama');
            $table->string('alamat');
            $table->string('status_nikah');
            $table->string('nama_pasangan')->nullable();
            $table->string('pekerjaan_pasangan')->nullable();
            $table->string('nip_pasangan')->nullable();
            $table->string('nama_ibu');
            $table->char('pendidikan_terakhir');
            $table->string('jurusan')->nullable();
            $table->string('nim')->nullable();
            $table->integer('tahun_masuk')->nullable();
            $table->integer('tahun_lulus')->nullable();
            $table->double('ipk')->nullable();
            $table->string('status_pegawai')->nullable();
            $table->string('tmt_pengangkatan')->nullable();
            $table->string('no_sk')->nullable();
            $table->date('tgl_sk')->nullable();
            $table->string('tmt_pns')->nullable();
            $table->string('no_sk_pns')->nullable();
            $table->date('tgl_sk_berkala')->nullable();
            $table->string('tmt_sekolah')->nullable();
            $table->date('tgl_sk_sekolah')->nullable();
            $table->string('no_sertifikasi')->nullable();
            $table->string('no_peserta_sertifikasi')->nullable();
            $table->string('nrg')->nullable();
            $table->date('tgl_masuk_sekolah')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('staff');
    }
}
