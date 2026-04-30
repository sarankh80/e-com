<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Slide') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('slides.update', $slide->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" name="title" value="{{ $slide->title }}" class="w-full border-gray-300 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Current Image</label>
                            @if($slide->image)
                                <img src="{{ Storage::url($slide->image) }}" class="w-40 h-20 object-cover rounded my-2">
                            @endif
                            <input type="file" name="image" class="w-full text-sm text-gray-500">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" rows="3" class="w-full border-gray-300 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">{{ $slide->description }}</textarea>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" {{ $slide->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Active</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md font-bold">Update Slide</button>
                        <a href="{{ route('slides.index') }}" class="ml-4 text-gray-500 underline">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>