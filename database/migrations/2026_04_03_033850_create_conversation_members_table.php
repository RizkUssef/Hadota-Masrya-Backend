<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('conversation_members', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('user_id');
            $table->string('role')->nullable()->default('MEMBER');
            $table->string('nickname', 100)->nullable();
            $table->string('is_muted')->nullable()->default('FALSE');
            $table->timestamp('muted_until')->nullable();
            $table->string('is_pinned')->nullable()->default('FALSE');
            $table->integer('unread_count')->nullable()->default('0');
            $table->timestamp('last_read_at')->nullable();
            $table->unsignedBigInteger('last_read_message_id')->nullable();
            $table->timestamp('joined_at')->nullable()->default('CURRENT_TIMESTAMP');
            $table->timestamp('left_at')->nullable();
            $table->unsignedBigInteger('invited_by')->nullable();
            $table->index('user_id', 'idx_members_user');
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade')->onUpdate('NO ACTION');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversation_members');
    }
};
