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
        Schema::table('produtos', function (Blueprint $table) {
            $table->string('codigo_de_pesquisa_1', 255)->nullable();
            $table->string('codigo_de_pesquisa_2', 255)->nullable();
            $table->string('codigo_de_pesquisa_3', 255)->nullable();
            $table->string('codigo_de_pesquisa_4', 255)->nullable();
            $table->string('codigo_de_pesquisa_5', 255)->nullable();
            $table->string('codigo_de_pesquisa_6', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
