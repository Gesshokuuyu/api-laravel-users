<?php

use App\Models\Item;
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
        Schema::create('item_supplies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer("quantity_available");
            $table->integer("used")->default(0);

            $table->foreignIdFor(Item::class)->constrained("items")
                                             ->cascadeOnDelete()
                                             ->unique();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_supplies');
    }
};
