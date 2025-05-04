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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();                   // BIGINT UNSIGNED, PRIMARY KEY
            $table->foreignId('user_id')    // BIGINT UNSIGNED, 外部キー
                  ->constrained('users')    // users.id に参照
                  ->onDelete('cascade');    // ユーザー削除時に投稿も削除

            $table->string('title', 255);    // VARCHAR(255), NULL不可
            $table->text('detail');          // TEXT, NULL不可

            $table->timestamps();            // created_at と updated_at
            $table->softDeletes();           // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
