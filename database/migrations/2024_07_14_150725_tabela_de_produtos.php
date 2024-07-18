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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255)->nullable();
            $table->text('descricao')->nullable();
            $table->string('codigo_interno', 255)->nullable();
            $table->string('codigo_externo', 255)->nullable();
            $table->string('marca', 255)->nullable();
            $table->string('grupo', 255)->nullable();
            $table->string('sub_grupo', 255)->nullable();
            $table->string('visivel', 255)->nullable();
            $table->string('image_url', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
