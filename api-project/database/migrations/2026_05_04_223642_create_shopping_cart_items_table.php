<?php

use App\Models\Item;
use App\Models\ShoppingCart;
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
        Schema::create('shopping_cart_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignIdFor(Item::class, 'item_id')->constrained('items')->cascadeOnDelete();
            $table->foreignIdFor(ShoppingCart::class, 'cart_id')->constrained('shopping_carts')->cascadeOnDelete();

            $table->decimal('price', 10, 2);
            $table->integer('quantity');

            $table->unique(['item_id', 'cart_id']);

            $table->index("cart_id");
            $table->index("item_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart_items');
    }
};
