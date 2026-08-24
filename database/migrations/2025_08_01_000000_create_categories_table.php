<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->unsignedInteger('parent_id')->nullable();
            $table->integer('order')->default(9999);
            lmpStamps($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
