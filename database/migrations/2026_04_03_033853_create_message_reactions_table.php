<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('message_reactions', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('message_id');
            $table->unsignedBigInteger('user_id');
            $table->string('emoji', 10);
            $table->timestamp('created_at')->nullable();
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade')->onUpdate('NO ACTION');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('message_reactions');
    }
};
