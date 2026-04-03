<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('message_reads', function (Blueprint $table) {

            $table->bigIncrements('id')->nullable();
            $table->unsignedBigInteger('message_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('read_at')->nullable()->default('CURRENT_TIMESTAMP');
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade')->onUpdate('NO ACTION');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('message_reads');
    }
};
