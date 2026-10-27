<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('order_number')->unique();

            $table->string('recipient_name');
            $table->string('phone');
            $table->string('email');

            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code', 10);

            $table->decimal('total_amount', 10, 2);

            $table->string('payment_method')->default('COD');
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};