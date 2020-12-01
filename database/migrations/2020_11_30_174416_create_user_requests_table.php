<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_requests', function (Blueprint $table) {
            $table->bigInteger('id', true, false);

            $table->bigInteger('user_id')->index()->nullable();
            $table->foreign('user_id', 'user_id_to_user_requests')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->bigInteger('game_method_id')->index()->nullable();
            $table->foreign('game_method_id', 'game_method_id_to_user_requests')
                ->references('id')->on('game_methods')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('actual_request');
            $table->integer('max_request');
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
        Schema::dropIfExists('user_requests');
    }
}
