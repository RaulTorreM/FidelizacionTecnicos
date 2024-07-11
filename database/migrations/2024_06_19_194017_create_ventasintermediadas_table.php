<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('VentasIntermediadas', function (Blueprint $table) {
            $table->string('idVentaIntermediada', 13)->primary(); //F001-00000072

            $table->string('idTecnico', 8)->nullable();
            $table->foreign('idTecnico')->references('idTecnico')->on('Tecnicos')->onDelete('set null');
            $table->string('nombreTecnico', 255);   
            
            $table->string('tipoCodigoCliente_VentaIntermediada', 3); //DNI - RUC
            $table->string('codigoCliente_VentaIntermediada', 8); //77043114
            $table->string('nombreCliente_VentaIntermediada', 100); //Josué García Betancourt
            $table->dateTime('fechaHoraEmision_VentaIntermediada'); 
            $table->dateTime('fechaHoraCargada_VentaIntermediada')->default(now());
            $table->double('montoTotal_VentaIntermediada')->unsigned(); //200.50
            $table->integer('puntosGanados_VentaIntermediada')->unsigned(); //201
            $table->string('estadoVentaIntermediada', 14); //Tiempo Agotado, Redimido, En espera
            $table->timestamps(); //created_at updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('VentasIntermediadas');
    }
};
