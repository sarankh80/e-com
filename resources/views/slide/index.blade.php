<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Slides') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('slides.create') }}" class="bg-black-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded m-2 float-right"> 
                {{ __('Create Slide') }}
            </a>
            <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                       <table class="table table-bordered w-full text-left text-sm text-gray-500 dark:text-gray-400 border-collapse border-gray-300 dark:border-gray-600" id="slides-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Title (Khmer)</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Parent</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slides as $slide)
                                    <tr>
                                        <td>{{ $slide->title }}</td>
                                        <td>{{ $slide->title_kh }}</td>
                                        <td>{{ $slide->slug }}</td>
                                        <td>
                                            @if($slide->image)
                                                <img src="{{ Storage::url($slide->image) }}" alt="{{ $slide->name }}" class="w-16 h-16 object-cover">
                                            @endif
                                        </td>
                                        <td>{{ $slide->parent ? $slide->parent->name : 'None' }}</td>
                                        <td>{{ $slide->is_active ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('slides.edit', $slide->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('slides.destroy', $slide->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>