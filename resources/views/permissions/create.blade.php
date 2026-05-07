<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Permission') }}
            </h2>

            <a href="{{ route('permissions.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded shadow">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <form action="{{ route('permissions.store') }}"
                      method="POST"
                      class="p-6 space-y-6">
                    @csrf

                    <div>
                        <label for="name"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Permission Name
                        </label>

                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               placeholder="Enter permission name"
                               class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring focus:ring-blue-200">

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
                            Save Permission
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>