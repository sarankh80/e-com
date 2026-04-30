<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('categories.create') }}" class="bg-black-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded fl"> {{ __('Create Category') }}</a>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                       <table class="table table-bordered w-full text-left text-sm text-gray-500 dark:text-gray-400 border-collapse  border-gray-300 dark:border-gray-600" id="categories-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Name (Khmer)</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Parent</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $cat)
                                    <tr>
                                        <td>{{ $cat->name }}</td>
                                        <td>{{ $cat->name_kh }}</td>
                                        <td>{{ $cat->slug }}</td>
                                        <td>
                                            @if($cat->image)
                                                <img src="{{ Storage::url($cat->image) }}" alt="{{ $cat->name }}" class="w-16 h-16 object-cover">
                                            @endif
                                        </td>
                                        <td>{{ $cat->parent ? $cat->parent->name : 'None' }}</td>
                                        <td>{{ $cat->is_active ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" style="display: inline;">
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