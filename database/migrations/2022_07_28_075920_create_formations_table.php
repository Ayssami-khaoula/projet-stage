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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('intitulé');
            $table->string('module');
            $table->string('type');
            $table->string('formateurs_id');
            $table->text('application_id');
            $table->string('population');
            $table->string('nombre_participants');
            $table->string('lieu');
            $table->string('durée');
            $table->string('date_début');
            $table->string('date_fin');
            $table->string('date_valide');
            $table->string('entité');
            $table->string('etat');
            $table->text('description');
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
        Schema::dropIfExists('formations');
    }
};
