<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarspbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftarspbs', function (Blueprint $table) {
            $table->id();
            $table->text('nomor_spb');
            $table->bigInteger('epoch_spb')->nullable();
            $table->boolean('isApproved')->nullable();
            $table->bigInteger('epoch_approved')->nullable();
            $table->boolean('isRealisasi')->nullable();
            $table->bigInteger('epoch_realisasi')->nullable();
            $table->boolean('isSbbk')->nullable();
            $table->bigInteger('epoch_sbbk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftarspbs');
    }
}
