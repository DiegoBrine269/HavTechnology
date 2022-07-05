<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uso_cfdi', function (Blueprint $table) {
            $table->id()->;
            $table->integer('id', true);
            $table->string('nombre', 40)->nullable();
            $table->char('RFC', 13)->nullable();
            $table->string('dirFiscal', 100)->nullable();
            $table->integer('CP')->nullable();
            $table->integer('usoCFDI')->nullable();
            $table->string('correo', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uso_cfdi');
    }
};
