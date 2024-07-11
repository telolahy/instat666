<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationColumnsToEtablsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('etablissements', function (Blueprint $table) {
            $table->unsignedBigInteger('fokontany_id')->nullable();
            $table->foreign('fokontany_id')->references('id')->on('fokontanies');
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
            $table->dropForeign(['fokontany_id']);

            $table->dropColumn([
                'fokontany_id'
            ]);
        });
    }
}
