<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('typing_indicators', function (Blueprint $table) {

            $table->bigIncrements('id')->nullable();
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('started_at')->nullable()->default('CURRENT_TIMESTAMP');
            $table->timestamp('expires_at');
            $table->index('expires_at', 'idx_typing_expiry');
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade')->onUpdate('NO ACTION');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('typing_indicators');
    }
};
