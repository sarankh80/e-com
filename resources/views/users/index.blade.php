<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-900">Users</h2>
            <a href="{{ route('users.create') }}" class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                + Add User
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">{{ session('error') }}</div>
            @endif

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                    <table id="users-table" data-dt class="admin-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 bg-gray-900 text-white rounded-full flex items-center justify-center font-bold text-sm uppercase shrink-0">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-900">{{ $user->name }}</div>
                                                <div class="text-xs text-gray-400">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($user->roles->count())
                                            @foreach($user->roles as $role)
                                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 mr-1">{{ $role->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-xs text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="flex justify-end items-center gap-4">
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Edit</a>
                                            @if(auth()->id() !== $user->id)
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700 transition-colors">Delete</button>
                                                </form>
                                            @else
                                                <span class="text-xs text-gray-300">You</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
