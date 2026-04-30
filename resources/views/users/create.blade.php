<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Full Name</label>
                            <input type="text" name="name" class="w-full border-gray-300 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email Address</label>
                            <input type="email" name="email" class="w-full border-gray-300 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Password</label>
                                <input type="password" name="password" class="w-full border-gray-300 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="w-full border-gray-300 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-bold">
                            Create User
                        </button>
                        <a href="{{ route('users.index') }}" class="ml-4 text-gray-500 underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>