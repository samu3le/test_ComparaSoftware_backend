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
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('last_name');
            $table->integer('type_document'); // 1 = CC, 2 = Pasaporte
            $table->string('document');
            $table->text('address');
            $table->string('phone');
            $table->string('email')->unique(); //->unique() para que no se repita el email
            $table->integer('gender'); // genero 1 = masculino, 2 = femenino, 3 = prefiero no decirlo
            $table->date('birth_date'); // fecha de nacimiento
            $table->integer('city'); // 1 = Bogota, 2 = Medellin, 3 = Cali
            $table->integer('marital_status'); // 1 = Soltero, 2 = Casado, 3 = Divorciado, 4 = Viudo
            $table->integer('occupation'); // 1-Estudiante, 2-Trabajador, 3-Independiente, 4-Otro
            $table->string('area');
            $table->double('salary');
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('people');
    }
};
