<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('theme')->nullable()->default('LIGHT');
            $table->string('language', 10)->nullable()->default('EN');
            $table->string('notification_sound')->nullable()->default('FALSE');
            $table->string('notification_preview')->nullable()->default('FALSE');
            $table->string('read_receipts')->nullable()->default('FALSE');
            $table->string('typing_indicators')->nullable()->default('FALSE');
            $table->string('online_status_visible')->nullable()->default('FALSE');
            $table->string('two_factor_enabled')->nullable()->default('FALSE');
            $table->string('two_factor_secret', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_settings');
    }
};
