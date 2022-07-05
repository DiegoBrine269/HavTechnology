<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniqueproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uniqueproducts', function (Blueprint $table) {
            $table->string('id', 20)->nullable()->index('fk_producto_unico');
            $table->string('idUnico', 30)->primary();
            $table->integer('lote')->nullable();
            $table->boolean('existe')->nullable();
            $table->integer('idProveedor')->nullable()->index('fk_producto_unico_proveedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uniqueproducts');
    }
}
