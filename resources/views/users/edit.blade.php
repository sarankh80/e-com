<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit User') }}: {{ $user->name }}
            </h2>

            <a href="{{ route('users.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded shadow">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.update', $user->id) }}"
                      method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">

                        <!-- Name -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-2">
                                Full Name
                            </label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   required
                                   class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-2">
                                Email Address
                            </label>

                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   required
                                   class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                        </div>

                        <!-- Role -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-2">
                                Role
                            </label>

                            <select name="role"
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500">

                                <option value="">Select Role</option>

                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ old('role', $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('role')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <hr class="border-gray-200 dark:border-gray-700">

                        <!-- Password -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">

                            <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-3 uppercase tracking-wider">
                                Change Password
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                Leave blank to keep current password.
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-2">
                                        New Password
                                    </label>

                                    <input type="password"
                                           name="password"
                                           class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-2">
                                        Confirm Password
                                    </label>

                                    <input type="password"
                                           name="password_confirmation"
                                           class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="mt-8 flex items-center gap-4">

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring ring-indigo-300 transition ease-in-out duration-150">
                            Update User
                        </button>

                        <a href="{{ route('users.index') }}"
                           class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                            Back to List
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>