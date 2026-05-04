<?php

use App\Models\Item;
use App\Models\Orders;
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
        Schema::create('orders_items', function (Blueprint $table) {
            $table->id()->index();
            $table->timestamps();
            $table->foreignIdFor(Orders::class, 'order_id')
                ->index()
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->foreignIdFor(Item::class, 'item_id')
                ->constrained('items')
                ->cascadeOnDelete();

            $table->float("unit_price");
            $table->integer("quantity");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_items');
    }
};
