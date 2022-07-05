<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSalesproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salesproducts', function (Blueprint $table) {
            $table->foreign(['idVenta'], 'fk_venta_producto_venta')->references(['id'])->on('sells');
            $table->foreign(['idProducto'], 'fk_venta_producto_producto')->references(['idUnico'])->on('uniqueproducts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salesproducts', function (Blueprint $table) {
            $table->dropForeign('fk_venta_producto_venta');
            $table->dropForeign('fk_venta_producto_producto');
        });
    }
}
