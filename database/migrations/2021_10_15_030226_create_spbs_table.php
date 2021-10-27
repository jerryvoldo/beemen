<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spbs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barang_id');
            $table->bigInteger('pemesan_id');
            $table->bigInteger('jumlah_pesanan');
            $table->text('nomor_spb');
            $table->text('peruntukan')->nullable();
            $table->bigInteger('epoch_entry')->nullable();
            $table->boolean('isAju')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spbs');
    }
}
