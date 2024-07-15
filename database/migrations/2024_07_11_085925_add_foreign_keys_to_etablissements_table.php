<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('etablissements', function (Blueprint $table) {
              // $table->unsignedBigInteger('province_id')->nullable();
              $table->unsignedBigInteger('region_id')->nullable();
              $table->unsignedBigInteger('district_id')->nullable();
              $table->unsignedBigInteger('commune_id')->nullable();
              // $table->unsignedBigInteger('fokontany_id')->nullable();

              // Ajouter les contraintes de clé étrangère
              // $table->foreign('province_id')->references('id')->on('provinces');
              $table->foreign('region_id')->references('id')->on('regions');
              $table->foreign('district_id')->references('id')->on('districts');
              $table->foreign('commune_id')->references('id')->on('communes');
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
         // $table->dropForeign(['province_id']);
         $table->dropForeign(['region_id']);
         $table->dropForeign(['district_id']);
         $table->dropForeign(['commune_id']);
         // $table->dropForeign(['fokontany_id']);

         $table->dropColumn([
             // 'province_id',
             'region_id',
             'district_id',
             'commune_id',
             // 'fokontany_id'
         ]);
     });
    }
}
