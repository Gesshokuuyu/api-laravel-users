<?php

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
        Schema::create('order_audits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignIdFor(Orders::class, 'order_id')->index()->constrained("orders")->cascadeOnDelete();
            $table->string("title", 150);
            $table->string("subtitle", 200);

            $table->text("content");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_audits');
    }
};
