<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('type')->nullable()->default('DIRECT');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('avatar_url', 500)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('last_message_id')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->string('is_archived')->nullable()->default('FALSE');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->index('last_activity_at', 'idx_conversations_activity');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversations');
    }
};
