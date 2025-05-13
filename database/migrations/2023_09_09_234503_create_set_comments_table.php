<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('set_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('set_id');
            $table->unsignedBigInteger('creator_id');
            $table->text('body');
            $table->timestamps();

            // Define foreign key relationships
            $table->foreign('set_id')->references('id')->on('sets')->onDelete('cascade');
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('set_comments');
    }
}