<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-900">Categories</h2>
            <a href="{{ route('categories.create') }}" class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                + Add Category
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
                    <table id="categories-table" data-dt class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Name (KH)</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Parent</th>
                                <th style="text-align:center">Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($category as $cat)
                                <tr>
                                    <td class="font-semibold text-gray-900">{{ $cat->name }}</td>
                                    <td class="text-gray-500">{{ $cat->name_kh ?? '—' }}</td>
                                    <td class="font-mono text-xs text-gray-400">{{ $cat->slug }}</td>
                                    <td>
                                        @if($cat->image)
                                            <img src="{{ Storage::url($cat->image) }}" class="w-10 h-10 object-cover rounded-lg border border-gray-200">
                                        @else
                                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-[9px]">IMG</div>
                                        @endif
                                    </td>
                                    <td class="text-gray-500">{{ $cat->parent?->name ?? '—' }}</td>
                                    <td style="text-align:center">
                                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $cat->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $cat->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex justify-end items-center gap-4">
                                            <a href="{{ route('categories.edit', $cat->id) }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Edit</a>
                                            <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700 transition-colors">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-16 text-center text-sm text-gray-400">No categories yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
