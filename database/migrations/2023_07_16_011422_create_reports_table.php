<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('reply_id')->nullable();
            $table->text('reason');
            $table->text('other_reason')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('reply_id')->references('id')->on('replies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            //
        });
    }
};
