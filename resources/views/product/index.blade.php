<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-900">Products</h2>
            <a href="{{ route('products.create') }}" class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                + Add Product
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table id="products-table" data-dt class="admin-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th class="text-center" style="text-align:center">Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-11 h-11 rounded-lg bg-gray-100 overflow-hidden shrink-0 border border-gray-200">
                                                @if($product->image)
                                                    <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-[9px] font-medium">IMG</div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-900">
                                                    {{ $product->name }}
                                                    @if($product->is_featured)<span class="text-yellow-400 ml-1">★</span>@endif
                                                </div>
                                                @if($product->name_kh)
                                                    <div class="text-xs text-gray-400 mt-0.5">{{ $product->name_kh }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-gray-500">{{ $product->category?->name ?? '—' }}</td>
                                    <td class="font-bold text-gray-900">${{ number_format($product->price, 2) }}</td>
                                    <td>
                                        @if($product->stock <= 5)
                                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">Low: {{ $product->stock }}</span>
                                        @else
                                            {{ $product->stock }}
                                        @endif
                                    </td>
                                    <td style="text-align:center">
                                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex justify-end items-center gap-4">
                                            <a href="{{ route('products.edit', $product->id) }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700 transition-colors">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-16 text-center">
                                        <p class="text-gray-400 text-sm">No products yet.</p>
                                        <a href="{{ route('products.create') }}" class="mt-2 inline-block text-sm font-semibold text-gray-900 underline">Add your first product</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
