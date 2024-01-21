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
        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('post_id', 'topic_id');
            $table->unsignedBigInteger('topic_id')->nullable()->change();
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->foreign('reply_id')->references('id')->on('post_replies')->onDelete('cascade');            
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
