<?php

use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained('categories')->onDelete('cascade');
            $table->string('name'); // Product name
            $table->text('description')->nullable(); // Optional description
            $table->string('size')->nullable(); // Product size
            $table->string('color')->nullable(); // Product color
            $table->decimal('price'); // Price with two decimal places
            $table->integer('quantity')->default(0); // Default quantity = 0
            $table->boolean('status')->default(1); // 1 = Active, 0 = Inactive
            $table->string('slug'); // URL-friendly slug
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
