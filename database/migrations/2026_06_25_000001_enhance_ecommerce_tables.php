<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /* ── brands ──────────────────────────────────────── */
        // Schema::create('brands', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('slug')->unique();
        //     $table->string('logo')->nullable();
        //     $table->string('website')->nullable();
        //     $table->text('description')->nullable();
        //     $table->boolean('is_active')->default(true);
        //     $table->integer('sort_order')->default(0);
        //     $table->timestamps();
        // });

        /* ── enhance products table ───────────────────────── */
        // Schema::table('products', function (Blueprint $table) {
        //     $table->unsignedBigInteger('brand_id')->nullable()->after('category_id');
        //     $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
        //     $table->string('sku')->nullable()->unique()->after('slug');
        //     $table->decimal('compare_price', 10, 2)->nullable()->after('price');
        //     $table->decimal('cost_price', 10, 2)->nullable()->after('compare_price');
        //     $table->string('unit')->default('pcs')->after('stock');
        //     $table->text('short_description')->nullable()->after('description');
        //     $table->json('tags')->nullable()->after('short_description');
        //     $table->json('specifications')->nullable()->after('tags');
        //     $table->boolean('is_new')->default(false)->after('is_featured');
        //     $table->boolean('is_on_sale')->default(false)->after('is_new');
        //     $table->integer('review_count')->default(0)->after('rating');
        //     $table->decimal('weight', 8, 2)->nullable();
        //     $table->string('meta_title')->nullable();
        //     $table->text('meta_description')->nullable();
        // });

        /* ── product_images ───────────────────────────────── */
        // Schema::create('product_images', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        //     $table->string('image');
        //     $table->string('alt')->nullable();
        //     $table->integer('sort_order')->default(0);
        //     $table->timestamps();
        // });

        /* ── product_variants ─────────────────────────────── */
        // Schema::create('product_variants', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        //     $table->string('name');           // e.g. "Color", "Size"
        //     $table->string('value');          // e.g. "Red", "XL"
        //     $table->string('sku')->nullable()->unique();
        //     $table->decimal('price_adjustment', 8, 2)->default(0);
        //     $table->integer('stock')->default(0);
        //     $table->string('image')->nullable();
        //     $table->boolean('is_active')->default(true);
        //     $table->integer('sort_order')->default(0);
        //     $table->timestamps();
        // });

        /* ── product_reviews ──────────────────────────────── */
        // Schema::create('product_reviews', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        //     $table->unsignedTinyInteger('rating')->default(5);
        //     $table->string('title')->nullable();
        //     $table->text('body')->nullable();
        //     $table->json('images')->nullable();
        //     $table->boolean('is_verified')->default(false);
        //     $table->boolean('is_approved')->default(false);
        //     $table->integer('helpful_count')->default(0);
        //     $table->timestamps();
        // });

        /* ── wishlists ────────────────────────────────────── */
        // Schema::create('wishlists', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        //     $table->timestamps();
        //     $table->unique(['user_id', 'product_id']);
        // });

        // /* ── carts ────────────────────────────────────────── */
        // Schema::create('carts', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        //     $table->string('session_id')->nullable()->index();
        //     $table->timestamps();
        // });

        // /* ── cart_items ───────────────────────────────────── */
        // Schema::create('cart_items', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('cart_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('variant_id')->nullable()->references('id')->on('product_variants')->nullOnDelete();
        //     $table->unsignedInteger('qty')->default(1);
        //     $table->decimal('price', 10, 2);
        //     $table->timestamps();
        // });

        // /* ── coupons ─────────────────────────────────────── */
        // Schema::create('coupons', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('code')->unique();
        //     $table->enum('type', ['percent', 'fixed'])->default('percent');
        //     $table->decimal('value', 10, 2);
        //     $table->decimal('min_order', 10, 2)->default(0);
        //     $table->decimal('max_discount', 10, 2)->nullable();
        //     $table->unsignedInteger('usage_limit')->nullable();
        //     $table->unsignedInteger('usage_count')->default(0);
        //     $table->boolean('is_active')->default(true);
        //     $table->date('starts_at')->nullable();
        //     $table->date('expires_at')->nullable();
        //     $table->timestamps();
        // });

        // /* ── shipping_addresses ───────────────────────────── */
        // Schema::create('shipping_addresses', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        //     $table->string('label')->default('Home');
        //     $table->string('full_name');
        //     $table->string('phone');
        //     $table->string('address_line1');
        //     $table->string('address_line2')->nullable();
        //     $table->string('city');
        //     $table->string('state')->nullable();
        //     $table->string('postal_code')->nullable();
        //     $table->string('country')->default('KH');
        //     $table->boolean('is_default')->default(false);
        //     $table->timestamps();
        // });

        // /* ── enhance orders table ─────────────────────────── */
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->foreignId('coupon_id')->nullable()->after('user_id')->constrained('coupons')->nullOnDelete();
        //     $table->foreignId('shipping_address_id')->nullable()->after('coupon_id')->constrained('shipping_addresses')->nullOnDelete();
        //     // $table->string('order_number')->unique()->nullable()->after('id');
        //     $table->decimal('subtotal', 10, 2)->default(0)->after('total');
        //     $table->decimal('discount', 10, 2)->default(0)->after('subtotal');
        //     $table->decimal('shipping_cost', 10, 2)->default(0)->after('discount');
        //     $table->decimal('tax', 10, 2)->default(0)->after('shipping_cost');
        //     $table->string('coupon_code')->nullable()->after('tax');
        //     $table->text('notes')->nullable()->after('coupon_code');
        //     $table->string('tracking_number')->nullable();
        //     $table->string('shipping_method')->nullable();
        //     $table->timestamp('paid_at')->nullable();
        //     $table->timestamp('shipped_at')->nullable();
        //     $table->timestamp('delivered_at')->nullable();
        // });

        // /* ── order_items ────────────────────────────────────── */
        // Schema::create('order_items', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('product_id')->constrained()->restrictOnDelete();
        //     $table->foreignId('variant_id')->nullable()->references('id')->on('product_variants')->nullOnDelete();
        //     $table->string('name');
        //     $table->string('sku')->nullable();
        //     $table->string('image')->nullable();
        //     $table->unsignedInteger('qty');
        //     $table->decimal('price', 10, 2);
        //     $table->decimal('total', 10, 2);
        //     $table->timestamps();
        // });

        // /* ── payments ─────────────────────────────────────── */
        // Schema::create('payments', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        //     $table->string('gateway');           // stripe, paypal, aba, khqr, wing, acleda
        //     $table->string('transaction_id')->nullable();
        //     $table->decimal('amount', 10, 2);
        //     $table->string('currency', 10)->default('USD');
        //     $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
        //     $table->json('gateway_response')->nullable();
        //     $table->timestamp('paid_at')->nullable();
        //     $table->timestamps();
        // });

        // /* ── notifications ───────────────────────────────── */
        // Schema::create('shop_notifications', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        //     $table->string('type');
        //     $table->string('title');
        //     $table->text('body')->nullable();
        //     $table->string('icon')->nullable();
        //     $table->string('url')->nullable();
        //     $table->timestamp('read_at')->nullable();
        //     $table->timestamps();
        // });

        // /* ── flash_sales ─────────────────────────────────── */
        // Schema::create('flash_sales', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title');
        //     $table->decimal('discount_percent', 5, 2);
        //     $table->timestamp('starts_at');
        //     $table->timestamp('ends_at');
        //     $table->boolean('is_active')->default(true);
        //     $table->timestamps();
        // });

        // Schema::create('flash_sale_products', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('flash_sale_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        //     $table->decimal('sale_price', 10, 2)->nullable();
        //     $table->integer('qty_limit')->nullable();
        //     $table->integer('qty_sold')->default(0);
        // });
    }

    public function down(): void
    {
        Schema::dropIfExists('flash_sale_products');
        Schema::dropIfExists('flash_sales');
        Schema::dropIfExists('shop_notifications');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['order_number', 'subtotal', 'discount', 'shipping_cost', 'tax', 'coupon_code', 'notes', 'tracking_number', 'shipping_method', 'paid_at', 'shipped_at', 'delivered_at']);
        });
        Schema::dropIfExists('shipping_addresses');
        Schema::dropIfExists('coupons');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('product_reviews');
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('product_images');
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['brand_id', 'sku', 'compare_price', 'cost_price', 'unit', 'short_description', 'tags', 'specifications', 'is_new', 'is_on_sale', 'review_count', 'weight', 'meta_title', 'meta_description']);
        });
        Schema::dropIfExists('brands');
    }
};
