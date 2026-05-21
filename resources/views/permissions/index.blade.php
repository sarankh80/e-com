<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-900">Permissions</h2>
            <a href="{{ route('permissions.create') }}" class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                + Add Permission
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                    <table id="permissions-table" data-dt class="admin-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Permission Name</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permissions as $permission)
                                <tr>
                                    <td class="text-gray-400">{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="inline-flex px-2.5 py-1 rounded-md text-sm font-medium bg-gray-100 text-gray-700">{{ $permission->name }}</span>
                                    </td>
                                    <td class="text-gray-500">{{ $permission->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="flex justify-end items-center gap-4">
                                            <a href="{{ route('permissions.edit', $permission->id) }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Edit</a>
                                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Delete this permission?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700 transition-colors">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-16 text-center text-sm text-gray-400">No permissions yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
