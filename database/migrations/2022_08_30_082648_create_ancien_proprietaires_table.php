<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAncienProprietairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ancien_proprietaires', function (Blueprint $table) {
            $table->id();
            $table->string('cin')->unique();
            $table->foreignId('etablissement_id')->constrained();
            $table->string('nom');
            $table->string('adresse');
            $table->string('num_tel');
            $table->string('commune');
            $table->string('email')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ancien_proprietaires');
    }
}
