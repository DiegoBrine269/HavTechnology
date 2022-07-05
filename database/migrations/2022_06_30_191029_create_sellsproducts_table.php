<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellsproducts', function (Blueprint $table) {
            $table->integer('idVenta');
            $table->string('idProducto', 20)->index('fk_venta_producto_producto');
            $table->integer('cantidad')->nullable();

            $table->primary(['idVenta', 'idProducto']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellsproducts');
    }
}
