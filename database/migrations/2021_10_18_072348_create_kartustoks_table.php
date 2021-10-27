<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartustoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartustoks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nomor_kartu');
            $table->bigInteger('masuk')->default(0);
            $table->bigInteger('keluar')->default(0);
            $table->bigInteger('sisa')->default(0);
            $table->text('nomor_spb')->nullable();
            $table->text('nomor_sbbk')->nullable();
            $table->bigInteger('epoch')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kartustoks');
    }
}
