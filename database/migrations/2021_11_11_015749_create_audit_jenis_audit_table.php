<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditJenisAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_jenis_audit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_id');
            $table->foreignId('jenis_audit_id');
            $table->timestamps();

            $table->foreign('audit_id')->references('no_audit')->on('laporan_audit');
            $table->foreign('jenis_audit_id')->references('id_jenis_audit')->on('jenis_audit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_jenis_audit');
    }
}
