<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUniqueproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uniqueproducts', function (Blueprint $table) {
            $table->foreign(['idProveedor'], 'fk_producto_unico_proveedor')->references(['id'])->on('providers');
            $table->foreign(['id'], 'fk_producto_unico')->references(['id'])->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uniqueproducts', function (Blueprint $table) {
            $table->dropForeign('fk_producto_unico_proveedor');
            $table->dropForeign('fk_producto_unico');
        });
    }
}
