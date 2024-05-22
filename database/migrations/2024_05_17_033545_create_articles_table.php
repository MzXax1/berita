<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Menambahkan kolom user_id
            $table->unsignedBigInteger('categories_id');
            $table->foreign('user_id')->references('id')->on('users'); // Menghubungkan user_id ke tabel users
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->string('title');
            $table->string('slug');
            $table->longText('desc');
            $table->string('img');
            $table->string('status');
            $table->unsignedInteger('views')->default(0); // Menggunakan unsignedInteger untuk views
            $table->date('publish_date');
            $table->timestamps();
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
