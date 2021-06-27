<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartaPortesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carta_portes', function (Blueprint $table) {
            $table->id();
            $table->string('toneladas');
            $table->string('precioPorTonelada');
            $table->string('precioPorSeguro');
            $table->string('chofer');
            $table->string('porcentaje');
            $table->string('nombre');
            $table->string('empresa');
            $table->string('identificadorCartaPorte');
            $table->string('totalFlete');
            $table->string('totalEntregado');
            $table->string('transferencia');
            $table->string('totalDisel');
            $table->string('estatusTransferencia');
            $table->string('facturaChofer');
            $table->string('retorno');
            $table->string('fecha');
            $table->string('factura');
            $table->string('reFactura');
            $table->string('compro');
            $table->string('remision');
            $table->string('entrega');
            $table->string('estatusPago');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carta_portes');
    }
}