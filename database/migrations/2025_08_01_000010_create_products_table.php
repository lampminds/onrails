<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('history')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('featured')->default(false);
            lmpStamps($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
