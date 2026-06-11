<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LUXE. | Modern E-Commerce</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS (via CDN for standalone demo) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .hidden-section { display: none !important; }
        .cart-overlay { opacity: 0; pointer-events: none; transition: opacity 0.3s ease; }
        .cart-overlay.active { opacity: 1; pointer-events: auto; }
        .cart-drawer { transform: translateX(100%); transition: transform 0.3s ease-out; }
        .cart-drawer.active { transform: translateX(0); }
        .booking-input { @apply w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black; }
    </style>
</head>
<body class="antialiased bg-white font-['figtree'] text-gray-900">

    @php
        $products = $products->map(function($prod) {
            return [
                'id' => $prod->id,
                'name' => $prod->name,
                'price' => $prod->price,
                'category' => $prod->category ? $prod->category->name : 'Uncategorized',
                'rating' => 4.5, // Placeholder rating
                'reviews' => 100, // Placeholder reviews count
                'image' => 'storage/' . $prod->image ?? 'https://via.placeholder.com/400x500?text=No+Image',
                'description' => $prod->description ?? 'No description available.'
            ];
        });
        // collect([
        //     ['id' => 1, 'name' => 'Premium Wireless Headphones', 'price' => 299.99, 'category' => 'Electronics', 'rating' => 4.8, 'reviews' => 124, 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=600&q=80', 'description' => 'Experience studio-quality sound with our flagship wireless headphones featuring active noise cancellation.'],
        //     ['id' => 2, 'name' => 'Minimalist Leather Watch', 'price' => 159.00, 'category' => 'Accessories', 'rating' => 4.6, 'reviews' => 89, 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=600&q=80', 'description' => 'A timeless timepiece designed for those who appreciate clean lines and premium materials.'],
        //     ['id' => 3, 'name' => 'Smart Fitness Tracker', 'price' => 89.99, 'category' => 'Electronics', 'rating' => 4.5, 'reviews' => 210, 'image' => 'https://images.unsplash.com/photo-1575311373937-040b8e1fd5b6?auto=format&fit=crop&w=600&q=80', 'description' => 'Track your health and performance with precision. Waterproof and 7-day battery life.'],
        //     ['id' => 4, 'name' => 'Ergonomic Desk Chair', 'price' => 450.00, 'category' => 'Furniture', 'rating' => 4.9, 'reviews' => 56, 'image' => 'https://images.unsplash.com/photo-1505843490701-5be5d2b33252?auto=format&fit=crop&w=600&q=80', 'description' => 'Redefine your workspace comfort with full lumbar support and premium breathable mesh.'],
        //     ['id' => 5, 'name' => 'Organic Cotton Hoodie', 'price' => 75.00, 'category' => 'Apparel', 'rating' => 4.7, 'reviews' => 142, 'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=600&q=80', 'description' => 'Sustainable fashion at its finest. Ultra-soft organic cotton for everyday comfort.'],
        //     ['id' => 6, 'name' => 'Compact Coffee Maker', 'price' => 120.00, 'category' => 'Kitchen', 'rating' => 4.4, 'reviews' => 95, 'image' => 'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?auto=format&fit=crop&w=600&q=80', 'description' => 'Professional grade coffee from the comfort of your home. Sleek design for any kitchen.']
        // ]);

        // $categories = ['All', 'Electronics', 'Accessories', 'Apparel', 'Furniture', 'Kitchen'];
        $categories = $categories->pluck('name');
    @endphp

    <!-- Navigation -->
    <nav class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2 cursor-pointer" onclick="app.setTab('home')">
                    <div class="bg-black text-white p-1.5 rounded-lg">
                        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight">LUXE.</span>
                </div>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center space-x-8">
                    <button onclick="app.setTab('home')" id="nav-home" class="nav-btn text-sm font-medium text-black">{{ __('lang.home') }}</button>
                    <button onclick="app.setTab('shop')" id="nav-shop" class="nav-btn text-sm font-medium text-gray-500 hover:text-black">{{ __('lang.shop') }}</button>
                    <button onclick="app.setTab('categories')" id="nav-categories" class="nav-btn text-sm font-medium text-gray-500 hover:text-black">{{ __('lang.categories') }}</button>
                    <button onclick="app.setTab('about')" id="nav-about" class="nav-btn text-sm font-medium text-gray-500 hover:text-black">{{ __('lang.about') }}</button>
                    <button onclick="app.setTab('booking')" id="nav-booking" class="nav-btn text-sm font-medium text-gray-500 hover:text-black">Booking</button>
                    @if(app()->getLocale() === 'en')
                        <a href="/lang/km" class="flex items-center gap-1 text-sm font-medium text-gray-500 hover:text-black">
                            <i data-lucide="globe" class="w-5 h-5"> </i> Khmer 
                        </a>
                    @endif
                    @if(app()->getLocale() === 'km')
                        <a href="/lang/en" class="flex items-center gap-1 text-sm font-medium text-gray-500 hover:text-black">
                            <i data-lucide="globe" class="w-5 h-5"> </i> English 
                        </a>
                    @endif
                    {{-- <a href="/lang/en">English</a>
                    <a href="/lang/km">Khmer</a> --}}

                </div>

                <!-- Icons -->
                <div class="flex items-center gap-4">
                    <button class="p-2 text-gray-500 hover:text-black hidden sm:block">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </button>
                    <button onclick="app.toggleCart(true)" class="p-2 text-gray-500 hover:text-black relative">
                        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        <span id="cart-count-badge" class="hidden absolute top-1 right-1 bg-black text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center"></span>
                    </button>
                    <button class="md:hidden p-2 text-gray-500" onclick="app.toggleMenu()">
                        <i id="menu-icon-open" data-lucide="menu" class="w-6 h-6"></i>
                        <i id="menu-icon-close" data-lucide="x" class="w-6 h-6 hidden"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-gray-100 px-4 py-4 space-y-4">
            <button onclick="app.setTab('home'); app.toggleMenu(false)" class="block w-full text-left text-lg font-medium">Home</button>
            <button onclick="app.setTab('shop'); app.toggleMenu(false)" class="block w-full text-left text-lg font-medium">Shop</button>
            <button onclick="app.setTab('categories'); app.toggleMenu(false)" class="block w-full text-left text-lg font-medium">Categories</button>
            <button onclick="app.setTab('account'); app.toggleMenu(false)" class="block w-full text-left text-lg font-medium">Account</button>
        </div>
    </nav>

    <!-- Cart Drawer -->
    <div id="cart-overlay" class="cart-overlay fixed inset-0 z-50 overflow-hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="app.toggleCart(false)"></div>
        <div id="cart-drawer" class="cart-drawer fixed right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl flex flex-col">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-xl font-bold">Shopping Cart (<span id="cart-title-count">0</span>)</h2>
                <button onclick="app.toggleCart(false)" class="p-2 hover:bg-gray-100 rounded-full">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <div id="cart-items-container" class="flex-1 overflow-y-auto p-6 space-y-6">
                <!-- Items injected by JS -->
            </div>

            <div id="cart-footer" class="hidden p-6 border-t border-gray-100 space-y-4">
                <div class="flex justify-between text-lg font-bold">
                    <span>Total</span>
                    <span id="cart-total-value">$0.00</span>
                </div>
                <button onclick="app.goToBooking()" class="w-full bg-black text-white py-4 rounded-xl font-bold hover:bg-gray-800 transition-colors">Checkout Now</button>
            </div>
        </div>
    </div>

    <!-- Booking Success Toast -->
    @if(session('booking_success'))
    <div id="booking-success-toast" class="fixed top-6 left-1/2 -translate-x-1/2 z-50 flex items-center gap-3 bg-green-600 text-white px-6 py-4 rounded-2xl shadow-2xl text-sm font-semibold transition-all duration-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <span>{{ session('booking_success') }}</span>
        <button onclick="document.getElementById('booking-success-toast').remove()" class="ml-2 opacity-70 hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
    </div>
    <script>
        setTimeout(() => { const t = document.getElementById('booking-success-toast'); if (t) t.remove(); }, 5000);
    </script>
    @endif

    <!-- Main Content -->
    <main>
        <!-- Home View -->
        <div id="view-home" class="view-section space-y-20 pb-20">
            <section class="relative h-[80vh] min-h-[600px] flex items-center overflow-hidden bg-gray-50">
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover opacity-60">
                    <div class="absolute inset-0 bg-gradient-to-r from-white/90 to-transparent"></div>
                </div>
                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-xl space-y-6">
                        <span class="inline-block px-4 py-1.5 bg-black text-white text-xs font-bold rounded-full uppercase tracking-wider">New Collection 2024</span>
                        <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 leading-[1.1]">Elevate Your <br><span class="text-gray-500">Everyday</span> Life.</h1>
                        <p class="text-lg text-gray-600 leading-relaxed">Curated essentials designed for the modern lifestyle. Quality craftsmanship meets minimalist aesthetic.</p>
                        <div class="flex gap-4 pt-4">
                            <button onclick="app.setTab('shop')" class="px-8 py-4 bg-black text-white rounded-xl font-bold flex items-center gap-2 hover:bg-gray-800 transition-all transform hover:-translate-y-1">
                                Shop Collection <i data-lucide="arrow-right" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Featured Products Grid -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold mb-10 text-gray-900">Featured Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products->take(3) as $product)
                        <div class="group">
                            <div class="relative aspect-[4/5] bg-gray-50 rounded-[2rem] overflow-hidden cursor-pointer" 
                                 onclick="app.viewProduct({{ Js::from($product) }})">
                                <img src="{{ $product['image'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute top-4 right-4 translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                    <button onclick="event.stopPropagation(); app.addToCart({{ Js::from($product) }})" class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-black hover:text-white">
                                        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4 px-2">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-bold text-gray-900 text-lg cursor-pointer" onclick="app.viewProduct({{ Js::from($product) }})">
                                        {{ $product['name'] }}
                                    </h3>
                                    <p class="font-bold text-black">${{ number_format($product['price'], 2) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <!-- Shop View -->
        <div id="view-shop" class="view-section hidden-section max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-4xl font-extrabold mb-8">All Products</h1>
            <div class="flex flex-wrap gap-2 mb-8">
                @foreach($categories as $cat)
                    <button id="cat-{{ $cat }}" onclick="app.setCategory('{{ $cat }}')" 
                            class="cat-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all {{ $cat === 'All' ? 'bg-black text-white' : 'bg-white text-gray-600 border border-gray-200' }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div class="product-card group" data-category="{{ $product['category'] }}">
                        <div class="relative aspect-[4/5] bg-gray-50 rounded-[2rem] overflow-hidden cursor-pointer" 
                             onclick="app.viewProduct({{ Js::from($product) }})">
                            <img src="{{ $product['image'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute top-4 right-4 translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                <button onclick="event.stopPropagation(); app.addToCart({{ Js::from($product) }})" class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-black hover:text-white">
                                    <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mt-4 px-2">
                            <h3 class="font-bold text-gray-900 cursor-pointer" onclick="app.viewProduct({{ Js::from($product) }})">
                                {{ $product['name'] }}
                            </h3>
                            <p class="font-bold text-black">${{ number_format($product['price'], 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Product Detail View -->
        <div id="view-product-detail" class="view-section hidden-section max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div id="product-detail-container">
                <!-- Injected via JS -->
            </div>
        </div>
        <!-- Categories View -->
        <div id="view-categories" class="view-section hidden-section max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-4xl font-extrabold mb-8">Categories</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($categories as $cat)
                    <div class="category-card bg-gray-100 rounded-lg p-6 text-center cursor-pointer hover:bg-gray-200" onclick="app.setCategory('{{ $cat }}')">
                        <h3 class="font-bold text-gray-900">{{ $cat }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- About View -->
        <div id="view-about" class="view-section hidden-section max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
            <h1 class="text-4xl font-extrabold mb-6">About LUXE.</h1>
            <p class="text-lg text-gray-600 leading-relaxed mb-6">LUXE. is a modern e-commerce platform built with Laravel 13 and Vanilla JavaScript. We are passionate about delivering high-quality products that blend style and functionality. Our mission is to elevate your everyday life with curated essentials designed for the modern lifestyle.</p>
            <p class="text-lg text-gray-600 leading-relaxed">From premium wireless headphones to minimalist leather watches, we offer a carefully selected range of products that embody quality craftsmanship and a minimalist aesthetic. Thank you for choosing LUXE. We hope you enjoy shopping with us!</p>
        </div>

        <!-- Booking View -->
        <div id="view-booking" class="view-section hidden-section max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-4xl font-extrabold mb-2">Booking</h1>
            <p class="text-gray-500 mb-10">Fill in your details and confirm your order below.</p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Customer Form -->
                <div>
                    <h2 class="text-xl font-bold mb-6">Your Information</h2>
                    <form id="booking-form" method="POST" action="{{ route('orders.store') }}" onsubmit="return app.prepareBooking(event)">
                        @csrf
                        <input type="hidden" name="order_number" id="booking-order-number">
                        <input type="hidden" name="items" id="booking-items">
                        <input type="hidden" name="total_amount" id="booking-total">
                        <input type="hidden" name="status" value="pending">
                        <input type="hidden" name="payment_method" id="booking-payment-method" value="cash">

                        <!-- Payment Method -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Payment Method <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 gap-3">
                                <!-- Cash -->
                                <label id="pay-cash-label" onclick="app.selectPayment('cash')"
                                    class="pay-method-btn flex items-center gap-3 border-2 border-black bg-black text-white rounded-xl px-4 py-3 cursor-pointer transition-all">
                                    <span class="text-xl">💵</span>
                                    <div>
                                        <p class="font-bold text-sm">Cash</p>
                                        <p class="text-xs opacity-70">Pay on delivery</p>
                                    </div>
                                </label>
                                <!-- Mastercard -->
                                <label id="pay-mastercard-label" onclick="app.selectPayment('mastercard')"
                                    class="pay-method-btn flex items-center gap-3 border-2 border-gray-200 bg-white text-gray-700 rounded-xl px-4 py-3 cursor-pointer transition-all hover:border-gray-400">
                                    <svg class="w-10 h-6 shrink-0" viewBox="0 0 48 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="48" height="30" rx="4" fill="#f5f5f5"/>
                                        <circle cx="18" cy="15" r="9" fill="#EB001B" opacity="0.9"/>
                                        <circle cx="30" cy="15" r="9" fill="#F79E1B" opacity="0.9"/>
                                        <path d="M24 8.2a9 9 0 0 1 0 13.6A9 9 0 0 1 24 8.2z" fill="#FF5F00"/>
                                    </svg>
                                    <div>
                                        <p class="font-bold text-sm">Mastercard</p>
                                        <p class="text-xs text-gray-400">Credit / Debit</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Card Details (shown only for Mastercard) -->
                        <div id="card-details" class="hidden mb-4 bg-gray-50 border border-gray-200 rounded-2xl p-4 space-y-3">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-sm font-bold text-gray-700">Card Details</p>
                                <svg class="w-10 h-6" viewBox="0 0 48 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="48" height="30" rx="4" fill="#f5f5f5"/>
                                    <circle cx="18" cy="15" r="9" fill="#EB001B" opacity="0.9"/>
                                    <circle cx="30" cy="15" r="9" fill="#F79E1B" opacity="0.9"/>
                                    <path d="M24 8.2a9 9 0 0 1 0 13.6A9 9 0 0 1 24 8.2z" fill="#FF5F00"/>
                                </svg>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Card Number</label>
                                <input type="text" id="card-number" maxlength="19" placeholder="1234 5678 9012 3456"
                                    oninput="app.formatCardNumber(this)"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black tracking-widest">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Name on Card</label>
                                <input type="text" id="card-name" placeholder="JOHN DOE"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black uppercase">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Expiry</label>
                                    <input type="text" id="card-expiry" maxlength="5" placeholder="MM/YY"
                                        oninput="app.formatExpiry(this)"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">CVV</label>
                                    <input type="password" id="card-cvv" maxlength="4" placeholder="•••"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="customer_name" required placeholder="John Doe"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" name="customer_email" required placeholder="john@example.com"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number</label>
                                <input type="tel" name="customer_phone" placeholder="+1 234 567 890"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Delivery Address <span class="text-red-500">*</span></label>
                                <textarea name="customer_address" required rows="3" placeholder="123 Main St, City, Country"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black resize-none"></textarea>
                            </div>
                        </div>

                        <div id="booking-empty-msg" class="hidden mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-xl text-sm text-yellow-700">
                            Your cart is empty. <button type="button" onclick="app.setTab('shop')" class="underline font-semibold">Add items</button> before booking.
                        </div>

                        <button type="submit"
                            class="mt-8 w-full bg-black text-white py-4 rounded-xl font-bold text-base hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                            <i data-lucide="check-circle" class="w-5 h-5"></i> Confirm Booking
                        </button>
                    </form>
                </div>

                <!-- Order Summary -->
                <div>
                    <h2 class="text-xl font-bold mb-6">Order Summary</h2>
                    <div id="booking-summary" class="space-y-4 bg-gray-50 rounded-2xl p-6">
                        <p class="text-gray-400 text-sm text-center py-8">No items in cart yet.</p>
                    </div>
                    <div id="booking-total-row" class="hidden flex justify-between items-center mt-4 px-2 pt-4 border-t border-gray-200">
                        <span class="font-bold text-lg">Total</span>
                        <span id="booking-total-display" class="font-bold text-xl">$0.00</span>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 pt-20 pb-10 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center items-center gap-2 mb-6">
                <div class="bg-black text-white p-1.5 rounded-lg">
                    <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                </div>
                <span class="text-xl font-bold tracking-tight">LUXE.</span>
            </div>
            <p class="text-gray-500 text-sm">© 2026 LUXE Store. Built with Laravel 13 and Vanilla JavaScript.</p>
        </div>
    </footer>

    <script>
        const app = {
            state: {
                activeTab: 'home',
                isCartOpen: false,
                isMenuOpen: false,
                selectedCategory: 'All',
                cart: [],
                selectedProduct: null,
                paymentMethod: 'cash'
            },

            init() {
                this.renderCart();
                lucide.createIcons();
            },

            setTab(tab) {
                this.state.activeTab = tab;
                document.querySelectorAll('.view-section').forEach(el => el.classList.add('hidden-section'));
                document.getElementById(`view-${tab}`).classList.remove('hidden-section');
                
                // Update nav styles
                document.querySelectorAll('.nav-btn').forEach(btn => {
                    btn.classList.remove('text-black');
                    btn.classList.add('text-gray-500');
                });
                const activeBtn = document.getElementById(`nav-${tab}`);
                if (activeBtn) {
                    activeBtn.classList.add('text-black');
                    activeBtn.classList.remove('text-gray-500');
                }
                window.scrollTo(0, 0);
                if (tab === 'booking') this.renderBookingSummary();
            },

            setCategory(cat) {
                this.state.selectedCategory = cat;
                document.querySelectorAll('.cat-btn').forEach(btn => {
                    btn.className = 'cat-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all bg-white text-gray-600 border border-gray-200';
                });
                document.getElementById(`cat-${cat}`).className = 'cat-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all bg-black text-white';
                
                document.querySelectorAll('.product-card').forEach(card => {
                    if (cat === 'All' || card.dataset.category === cat) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            },

            toggleMenu(force) {
                this.state.isMenuOpen = force !== undefined ? force : !this.state.isMenuOpen;
                const menu = document.getElementById('mobile-menu');
                const openIcon = document.getElementById('menu-icon-open');
                const closeIcon = document.getElementById('menu-icon-close');
                
                if (this.state.isMenuOpen) {
                    menu.classList.remove('hidden');
                    openIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                } else {
                    menu.classList.add('hidden');
                    openIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            },

            toggleCart(open) {
                this.state.isCartOpen = open;
                const overlay = document.getElementById('cart-overlay');
                const drawer = document.getElementById('cart-drawer');
                if (open) {
                    overlay.classList.add('active');
                    drawer.classList.add('active');
                } else {
                    overlay.classList.remove('active');
                    drawer.classList.remove('active');
                }
            },

            addToCart(product) {
                const existing = this.state.cart.find(i => i.id === product.id);
                if (existing) {
                    existing.quantity++;
                } else {
                    this.state.cart.push({ ...product, quantity: 1 });
                }
                this.renderCart();
                this.toggleCart(true);
            },

            updateQuantity(id, delta) {
                const item = this.state.cart.find(i => i.id === id);
                if (item) {
                    item.quantity += delta;
                    if (item.quantity <= 0) {
                        this.state.cart = this.state.cart.filter(i => i.id !== id);
                    }
                }
                this.renderCart();
            },

            viewProduct(product) {
                this.state.selectedProduct = product;
                const container = document.getElementById('product-detail-container');
                container.innerHTML = `
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24">
                        <div class="aspect-[4/5] bg-gray-50 rounded-[2.5rem] overflow-hidden">
                            <img src="${product.image}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col justify-center space-y-8">
                            <div class="flex items-center gap-4">
                                <button onclick="app.setTab('shop')" class="text-sm font-bold flex items-center gap-1 text-gray-400 hover:text-black transition-colors">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i> Back to Shop
                                </button>
                            </div>
                            <div>
                                <p class="text-gray-500 font-medium uppercase tracking-widest text-xs">${product.category}</p>
                                <h1 class="text-4xl font-extrabold text-gray-900">${product.name}</h1>
                            </div>
                            <p class="text-3xl font-bold text-black">$${product.price.toFixed(2)}</p>
                            <p class="text-lg text-gray-600 leading-relaxed">${product.description}</p>
                            <button onclick='app.addToCart(${JSON.stringify(product)})' class="w-full bg-black text-white py-5 rounded-2xl font-bold text-lg hover:bg-gray-800 transition-all">
                                Add to Shopping Cart
                            </button>
                        </div>
                    </div>
                `;
                this.setTab('product-detail');
                lucide.createIcons();
            },

            goToBooking() {
                this.toggleCart(false);
                this.setTab('booking');
                this.renderBookingSummary();
            },

            renderBookingSummary() {
                const summary = document.getElementById('booking-summary');
                const totalRow = document.getElementById('booking-total-row');
                const totalDisplay = document.getElementById('booking-total-display');
                const emptyMsg = document.getElementById('booking-empty-msg');

                if (this.state.cart.length === 0) {
                    summary.innerHTML = '<p class="text-gray-400 text-sm text-center py-8">No items in cart yet.</p>';
                    totalRow.classList.add('hidden');
                    emptyMsg.classList.remove('hidden');
                    return;
                }

                emptyMsg.classList.add('hidden');
                totalRow.classList.remove('hidden');
                const total = this.state.cart.reduce((s, i) => s + i.price * i.quantity, 0);
                totalDisplay.innerText = `$${total.toFixed(2)}`;

                summary.innerHTML = this.state.cart.map(item => `
                    <div class="flex gap-4 items-center">
                        <img src="${item.image}" class="w-16 h-20 object-cover rounded-xl bg-gray-100">
                        <div class="flex-1">
                            <p class="font-semibold text-sm text-gray-900 leading-snug">${item.name}</p>
                            <p class="text-xs text-gray-500 mt-0.5">Qty: ${item.quantity}</p>
                        </div>
                        <p class="font-bold text-sm">$${(item.price * item.quantity).toFixed(2)}</p>
                    </div>
                `).join('');
                lucide.createIcons();
            },

            selectPayment(method) {
                this.state.paymentMethod = method;
                document.getElementById('booking-payment-method').value = method;
                const cashLabel = document.getElementById('pay-cash-label');
                const cardLabel = document.getElementById('pay-mastercard-label');
                const cardDetails = document.getElementById('card-details');
                if (method === 'mastercard') {
                    cardLabel.className = 'pay-method-btn flex items-center gap-3 border-2 border-black bg-black text-white rounded-xl px-4 py-3 cursor-pointer transition-all';
                    cashLabel.className = 'pay-method-btn flex items-center gap-3 border-2 border-gray-200 bg-white text-gray-700 rounded-xl px-4 py-3 cursor-pointer transition-all hover:border-gray-400';
                    cardDetails.classList.remove('hidden');
                } else {
                    cashLabel.className = 'pay-method-btn flex items-center gap-3 border-2 border-black bg-black text-white rounded-xl px-4 py-3 cursor-pointer transition-all';
                    cardLabel.className = 'pay-method-btn flex items-center gap-3 border-2 border-gray-200 bg-white text-gray-700 rounded-xl px-4 py-3 cursor-pointer transition-all hover:border-gray-400';
                    cardDetails.classList.add('hidden');
                }
            },

            formatCardNumber(input) {
                let v = input.value.replace(/\D/g, '').substring(0, 16);
                input.value = v.match(/.{1,4}/g)?.join(' ') ?? v;
            },

            formatExpiry(input) {
                let v = input.value.replace(/\D/g, '').substring(0, 4);
                if (v.length >= 3) v = v.substring(0, 2) + '/' + v.substring(2);
                input.value = v;
            },

            prepareBooking(e) {
                if (this.state.cart.length === 0) {
                    e.preventDefault();
                    document.getElementById('booking-empty-msg').classList.remove('hidden');
                    return false;
                }
                if (this.state.paymentMethod === 'mastercard') {
                    const num = document.getElementById('card-number').value.replace(/\s/g, '');
                    const expiry = document.getElementById('card-expiry').value;
                    const cvv = document.getElementById('card-cvv').value;
                    if (num.length < 16 || expiry.length < 5 || cvv.length < 3) {
                        e.preventDefault();
                        alert('Please fill in all card details correctly.');
                        return false;
                    }
                }
                const ts = Date.now();
                document.getElementById('booking-order-number').value = ts;
                document.getElementById('booking-items').value = JSON.stringify(this.state.cart);
                const total = this.state.cart.reduce((s, i) => s + i.price * i.quantity, 0);
                document.getElementById('booking-total').value = total.toFixed(2);
                return true;
            },

            renderCart() {
                const container = document.getElementById('cart-items-container');
                const badge = document.getElementById('cart-count-badge');
                const titleCount = document.getElementById('cart-title-count');
                const footer = document.getElementById('cart-footer');
                const totalVal = document.getElementById('cart-total-value');
                
                const count = this.state.cart.reduce((sum, item) => sum + item.quantity, 0);
                const total = this.state.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

                titleCount.innerText = count;
                if (count > 0) {
                    badge.innerText = count;
                    badge.classList.remove('hidden');
                    footer.classList.remove('hidden');
                    totalVal.innerText = `$${total.toFixed(2)}`;
                    
                    container.innerHTML = this.state.cart.map(item => `
                        <div class="flex gap-4">
                            <img src="${item.image}" class="w-20 h-24 object-cover rounded-lg bg-gray-50" />
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-medium text-gray-900 leading-tight">${item.name}</h4>
                                    <p class="font-semibold">$${(item.price * item.quantity).toFixed(2)}</p>
                                </div>
                                <div class="flex items-center justify-between mt-4">
                                    <div class="flex items-center border rounded-lg">
                                        <button onclick="app.updateQuantity(${item.id}, -1)" class="px-2 py-1 hover:bg-gray-50">-</button>
                                        <span class="px-3 py-1 text-sm border-x">${item.quantity}</span>
                                        <button onclick="app.updateQuantity(${item.id}, 1)" class="px-2 py-1 hover:bg-gray-50">+</button>
                                    </div>
                                    <button onclick="app.updateQuantity(${item.id}, -${item.quantity})" class="text-sm text-red-500 hover:text-red-700 font-medium">Remove</button>
                                </div>
                            </div>
                        </div>
                    `).join('');
                } else {
                    badge.classList.add('hidden');
                    footer.classList.add('hidden');
                    container.innerHTML = `
                        <div class="h-full flex flex-col items-center justify-center text-gray-400 space-y-4">
                            <i data-lucide="shopping-bag" class="w-12 h-12 stroke-1"></i>
                            <p>Your cart is empty</p>
                            <button onclick="app.toggleCart(false); app.setTab('shop')" class="text-black font-semibold underline">Start Shopping</button>
                        </div>
                    `;
                }
                lucide.createIcons();
            }
        };

        window.onload = () => app.init();
    </script>
</body>
</html>