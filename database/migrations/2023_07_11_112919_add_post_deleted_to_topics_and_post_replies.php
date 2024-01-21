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
        Schema::table('topics,post_replies', function (Blueprint $table) {
            Schema::table('topics', function (Blueprint $table) {
                $table->boolean('post_deleted')->default(false);
            });
    
            Schema::table('post_replies', function (Blueprint $table) {
                $table->boolean('post_deleted')->default(false);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('topics,post_replies', function (Blueprint $table) {
            //
        });
    }
};
