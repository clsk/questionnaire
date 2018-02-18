<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserFkToQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questionnaires', function (Blueprint $table) {
            // first add column
            $table->integer('user_id')->unsigned();
        });

        Schema::table('questionnaires', function (Blueprint $table) {
            // then add FK constriant
            $table->foreign('user_id')->references('id')->on('questions')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questionnaires', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
        });
    }
}
