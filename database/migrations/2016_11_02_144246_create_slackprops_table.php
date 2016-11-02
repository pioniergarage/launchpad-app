<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlackpropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slack_props', function (Blueprint $table) {
            $table->increments('id');

            $table->string('message');
            $table->string('activity');
            $table->string('ts');

            $table->string('author_id');
            $table->foreign('author_id')
                ->references('id')
                ->on('slack_users')
                ->onDelete('cascade');

            $table->string('receiver_id');
            $table->foreign('receiver_id')
                ->references('id')
                ->on('slack_users')
                ->onDelete('cascade');

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
        Schema::drop('slack_props');
    }
}
