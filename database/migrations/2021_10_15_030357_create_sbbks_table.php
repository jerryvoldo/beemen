<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbbksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sbbks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('epoch_pengeluaran');
            $table->text('nomor_spb');
            $table->bigInteger('nip_penerima');
            $table->bigInteger('epoch_sbbk')->nullable();
            $table->text('nomor_sbbk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sbbks');
    }
}
