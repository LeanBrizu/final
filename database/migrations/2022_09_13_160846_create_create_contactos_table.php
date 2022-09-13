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
        Schema::create('create_contactos', function (Blueprint $table) {
            
            $table->id();

            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('telefono');//->nullable()
            $table->string('apellido');
            $table->string('mensaje');

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
        Schema::dropIfExists('create_contactos');
    }
};
