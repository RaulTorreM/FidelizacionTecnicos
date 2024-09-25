<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('login_tecnicos', function (Blueprint $table) {
            $table->string('idTecnico', 8)->primary();
            $table->string('password');
            $table->foreign('idTecnico')
                  ->references('idTecnico')
                  ->on('Tecnicos')
                  ->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_tecnicos');
    }
};
