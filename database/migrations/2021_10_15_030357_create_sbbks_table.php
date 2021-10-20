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
            $table->bigInteger('nomor_spb');
            $table->bigInteger('nip_penerima');
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
        Schema::dropIfExists('sbbks');
    }
}
