<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();
            $table->string('num_entreprise')->nullable();
            $table->string('identification_stat');
            $table->string('sigle');
            $table->string('adresse_etab');
            $table->string('num_patente');
            $table->string('comptabilite');
            $table->string('fond');
            $table->string('duplicata');
            $table->string('bp');
            $table->string('status');
            $table->string('tel_etab');
            $table->string('type');
            // $table->foreignId('fokontany_id')->constrained();
            // $table->foreignId('activite_id')->constrained();
            // $table->string('activite_sec1')->nullable();
            // $table->string('activite_sec2')->nullable();
            $table->foreignId('lchef_id')->constrained();
            $table->foreignId('juridique_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('proprietaire_id')->constrained();
            // $table->foreignId('commune_id')->constrained();
            $table->string('malagasy_m');
            $table->string('malagasy_f');
            $table->string('etranger_m');
            $table->string('etranger_f');
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
        Schema::dropIfExists('etablissements');
    }
}
