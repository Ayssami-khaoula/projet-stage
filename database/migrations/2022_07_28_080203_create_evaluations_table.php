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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formations_id')->onDelete('cascade');
            $table->text('remarque_formation');
            $table->string('note_formation');
            $table->text('remarque_formateur');
            $table->string('note_formateur');
            $table->text('remarque_participant');
            $table->string('note_participant');
            //$table->string('moyenne');
            $table->boolean('is_evaluate')->default(false);
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
        Schema::dropIfExists('evaluations');
    }
};
