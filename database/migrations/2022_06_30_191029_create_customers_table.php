<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 40)->nullable();
            $table->char('RFC', 13)->nullable();
            $table->string('dirFiscal', 100)->nullable();
            $table->integer('CP')->nullable();
            $table->integer('usoCFDI')->nullable();
            $table->string('correo', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
