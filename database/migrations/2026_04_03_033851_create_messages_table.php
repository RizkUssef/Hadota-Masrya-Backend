<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {

            $table->bigIncrements('id')->nullable();
            $table->string('uuid');
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('reply_to_id')->nullable();
            $table->string('type')->nullable()->default('TEXT');
            $table->text('content')->nullable();
            $table->string('metadata')->nullable();
            $table->string('is_edited')->nullable()->default('FALSE');
            $table->timestamp('edited_at')->nullable();
            $table->string('is_deleted')->nullable()->default('FALSE');
            $table->timestamp('sent_at')->nullable()->default('CURRENT_TIMESTAMP');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->index(['conversation_id', 'id'], 'idx_messages_conv');
            $table->index('user_id', 'idx_messages_user');
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade')->onUpdate('NO ACTION');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('reply_to_id')->references('id')->on('messages')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
