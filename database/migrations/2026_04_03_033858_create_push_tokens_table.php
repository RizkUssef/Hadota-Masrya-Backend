<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('push_tokens', function (Blueprint $table) {

            $table->bigIncrements('id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('token', 500);
            $table->string('platform');
            $table->string('device_name', 200)->nullable();
            $table->string('is_active')->nullable()->default('FALSE');
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->index(['user_id', 'is_active'], 'idx_tokens_user');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('push_tokens');
    }
};
