<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Product List') }}
            </h2>
            <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm transition">
                + Add New Product
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                    {{ session('success') }}
                </div>
            @endif
            <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-black font-bold py-2 px-4 rounded text-sm transition float-right">
                + Add New Product
            </a>
            <div style="clear: both" class="clear-both"></div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider text-center">Status</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @forelse($products as $product)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12 border dark:border-gray-600 rounded overflow-hidden bg-gray-100">
                                                @if($product->image)
                                                    <img src="{{ Storage::url($product->image) }}" class="h-full w-full object-cover">
                                                @else
                                                    <div class="h-full w-full flex items-center justify-center text-gray-400 text-[10px]">No Image</div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900 dark:text-white">
                                                    {{ $product->name }}
                                                    @if($product->is_featured)
                                                        <span class="ml-1 text-yellow-500" title="Featured">★</span>
                                                    @endif
                                                </div>
                                                <div class="text-xs text-gray-500">{{ $product->name_kh }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $product->category ? $product->category->name : 'Uncategorized' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                                        ${{ number_format($product->price, 2) }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($product->stock <= 5)
                                            <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-1 rounded">Low: {{ $product->stock }}</span>
                                        @else
                                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ $product->stock }}</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-3">
                                            <a href="{{ route('products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400">Edit</a>
                                            
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:hover:text-red-400">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">
                                        No products found. <a href="{{ route('products.create') }}" class="text-indigo-600 underline">Add your first product.</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($products->hasPages())
                    <div class="p-6 bg-gray-50 dark:bg-gray-700 border-t dark:border-gray-600">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>