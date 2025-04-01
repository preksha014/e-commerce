<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Customer;
use App\Models\Order;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class)->constrained('customers')->onDelete('cascade');
            $table->foreignIdFor(Order::class)->constrained('orders')->onDelete('cascade');
            $table->string('street');
            $table->string('city');
            $table->string('zipcode');
            $table->string('recipient_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_addresses');
    }
};
