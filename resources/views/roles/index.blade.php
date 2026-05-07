<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users Management') }}
            </h2>
            <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                + Add User
            </a>
        </div>
    </x-slot>
<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-6 py-4 font-bold text-gray-700 uppercase border-b">Role Name</th>
                <th class="px-6 py-4 font-bold text-gray-700 uppercase border-b">Permissions</th>
                <th class="px-6 py-4 font-bold text-gray-700 uppercase border-b text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 border-b">
                    <span class="font-medium text-gray-900">{{ ucfirst($role->name) }}</span>
                </td>
                <td class="px-6 py-4 border-b">
                    <div class="flex flex-wrap gap-1">
                        @forelse($role->permissions as $permission)
                            <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                {{ $permission->name }}
                            </span>
                        @empty
                            <span class="text-xs italic text-gray-400">No permissions assigned</span>
                        @endforelse
                    </div>
                </td>
                <td class="px-6 py-4 text-right border-b">
                    @can('edit roles')
                        <a href="{{ route('roles.edit', $role->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                    @endcan
                    
                    @can('delete roles')
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>