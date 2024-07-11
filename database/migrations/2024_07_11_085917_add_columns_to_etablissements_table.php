<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('etablissements', function (Blueprint $table) {
            $table->string('activite_princ')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('groupe_id')->nullable();
            $table->unsignedBigInteger('classe_id')->nullable();
            $table->unsignedBigInteger('categorie_id')->nullable();

            $table->string('activite_sec1')->nullable();
            $table->string('section_sec1')->nullable();
            $table->string('division_sec1')->nullable();
            $table->string('groupe_sec1')->nullable();
            $table->string('classe_sec1')->nullable();
            $table->string('categorie_sec1')->nullable();

            $table->string('activite_sec2')->nullable();
            $table->string('section_sec2')->nullable();
            $table->string('division_sec2')->nullable();
            $table->string('groupe_sec2')->nullable();
            $table->string('classe_sec2')->nullable();
            $table->string('categorie_sec2')->nullable();

            // Ajouter les contraintes de clé étrangère
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('groupe_id')->references('id')->on('groupes');
            $table->foreign('classe_id')->references('id')->on('classes');
            $table->foreign('categorie_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('etablissements', function (Blueprint $table) {
            $table->dropForeign(['section_id']);
            $table->dropForeign(['division_id']);
            $table->dropForeign(['groupe_id']);
            $table->dropForeign(['classe_id']);
            $table->dropForeign(['categorie_id']);
            
            $table->dropColumn([
                'section_id', 
                'division_id', 
                'groupe_id', 
                'classe_id', 
                'categorie_id',
                'activite_princ', 
                'activite_sec1', 
                'activite_sec2', 
                'section_sec1',
                'division_sec1',
                'groupe_sec1',
                'classe_sec1',
                'categorie_sec1',
                'section_sec2',
                'division_sec2',
                'groupe_sec2',
                'classe_sec2',
                'categorie_sec2'
            ]);
        });
    }
}
