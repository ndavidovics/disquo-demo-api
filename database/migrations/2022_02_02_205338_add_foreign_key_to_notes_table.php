<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            //
            $table->bigInteger('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            //
            $table->dropForeign('lists_user_id_foreign');
            $table->dropIndex('lists_user_id_index');
            $table->integer('user_id')->change();
        });
    }
}
