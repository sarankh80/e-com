<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Product Name (EN)')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="name_kh" :value="__('Product Name (KH)')" />
                                <x-text-input id="name_kh" name="name_kh" type="text" class="mt-1 block w-full" :value="old('name_kh')" />
                                <x-input-error class="mt-2" :messages="$errors->get('name_kh')" />
                            </div>

                            <div>
                                <x-input-label for="price" :value="__('Price ($)')" />
                                <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" :value="old('price', '0.00')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>

                            <div>
                                <x-input-label for="stock" :value="__('Initial Stock')" />
                                <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', '0')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                            </div>

                            <div>
                                <x-input-label for="category_id" :value="__('Category')" />
                                <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Select a Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                            </div>

                            <div>
                                <x-input-label for="image" :value="__('Product Image')" />
                                <input id="image" name="image" type="file" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-input-label for="description" :value="__('Product Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="mt-6 flex flex-wrap gap-6">
                            <div class="flex items-center">
                                <input id="is_active" name="is_active" type="checkbox" value="1" checked class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="is_active" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Published / Active') }}</label>
                            </div>

                            <div class="flex items-center">
                                <input id="is_featured" name="is_featured" type="checkbox" value="1" class="w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="is_featured" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Mark as Featured') }}</label>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 pt-6 border-t dark:border-gray-700">
                            <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Create Product') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>