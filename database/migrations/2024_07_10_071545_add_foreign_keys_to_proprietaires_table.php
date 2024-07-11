<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProprietairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proprietaires', function (Blueprint $table) {
            $table->foreignId('province_id')->constrained('provinces'); // Clé étrangère province_id
            $table->foreignId('region_id')->constrained('regions'); // Clé étrangère region_id
            $table->foreignId('district_id')->constrained('districts'); // Clé étrangère district_id
            $table->foreignId('commune_id')->constrained('communes'); // Clé étrangère commune_id
            $table->foreignId('fokontany_id')->constrained('fokontanies'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proprietaires', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
            $table->dropForeign(['region_id']);
            $table->dropForeign(['district_id']);
            $table->dropForeign(['commune_id']);
            $table->dropForeign(['fokontany_id']);
        });
    }
}
