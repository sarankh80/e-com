<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Slide') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('slides.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Title (EN)</label>
                                <input type="text" name="title" class="w-full border-gray-300 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Title (KH)</label>
                                <input type="text" name="title_kh" class="w-full border-gray-300 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" rows="3" class="w-full border-gray-300 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"></textarea>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Slide Image</label>
                            <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500">
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" checked class="rounded border-gray-300 text-indigo-600 shadow-sm">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Active Status</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Save Slide
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>