<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Roles Management') }}
            </h2>

            <a href="{{ route('roles.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                + Add Role
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="p-4">#</th>
                            <th class="p-4">Role Name</th>
                            <th class="p-4">Permissions</th>
                            <th class="p-4">Created At</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                        @forelse($roles as $role)
                            <tr>
                                <td class="p-4">{{ $loop->iteration }}</td>

                                <td class="p-4 text-gray-900 dark:text-gray-100">
                                    {{ $role->name }}
                                </td>

                                <td class="p-4">
                                    @foreach($role->permissions as $permission)
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs mr-1">
                                            {{ $permission->name }}
                                        </span>
                                    @endforeach
                                </td>

                                <td class="p-4 text-gray-500">
                                    {{ $role->created_at->format('M d, Y') }}
                                </td>

                                <td class="p-4 text-right">
                                    <a href="{{ route('roles.edit', $role->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900 mr-3">
                                        Edit
                                    </a>

                                    <form action="{{ route('roles.destroy', $role->id) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Delete this role?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">
                                    No roles found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-4">
                    {{ $roles->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>