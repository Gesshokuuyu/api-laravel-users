<?php

use App\Models\Addresses;
use App\Models\Coupons;
use App\Models\ShippingCompanies;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("num_order_seller");
            $table->unique(['num_order_seller', 'seller_id']);

            $table->foreignIdFor(User::class, 'buyer_id')->constrained('users')->restrictOnDelete();
            $table->foreignIdFor(User::class, 'seller_id')->constrained('users')->restrictOnDelete();

            $table->foreignIdFor(Addresses::class, 'shipping_addresses_id')->constrained('addresses');
            $table->foreignIdFor(ShippingCompanies::class, 'shipping_company_id')->constrained('shipping_companies');

            $table->foreignIdFor(Coupons::class, 'coupon_id')->nullable()->constrained('coupons');

            $table->enum('status', [
                'pending',
                'paid',
                'shipped',
                'delivered',
                'canceled',
                'refund'
            ]);

            $table->enum("payment_method",[
                'pix',
                'credit_card',
                'debit_card',
                'billet'
            ]);
            $table->integer("installment")->nullable();
            $table->enum("payment_status", [
                "pending",
                "approved",
                "failed"
            ]);

            $table->decimal("subtotal", 10, 2);
            $table->decimal("discount", 10, 2);
            $table->decimal("shipping_cost", 10, 2);
            $table->decimal("total", 10, 2);

            $table->text("additional_details")->nullable();

            $table->timestamp("purchased_at")->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
