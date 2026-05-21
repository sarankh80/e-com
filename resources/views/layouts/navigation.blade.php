<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center me-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="bg-white text-gray-900 p-1.5 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        </div>
                        <span class="text-white font-bold tracking-tight text-lg">LUXE. <span class="text-gray-400 font-normal text-sm">Admin</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:flex">
                    @php
                        $navLink = fn($route, $label) => '<a href="' . route($route) . '" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors ' . (request()->routeIs($route) ? 'bg-white text-gray-900' : 'text-gray-400 hover:text-white hover:bg-gray-800') . '">' . $label . '</a>';
                    @endphp
                    {!! $navLink('dashboard', 'Dashboard') !!}
                    {!! $navLink('products.index', 'Products') !!}
                    {!! $navLink('categories.index', 'Categories') !!}
                    @can('view Slides')
                    {!! $navLink('slides.index', 'Slides') !!}
                    @endcan
                    {!! $navLink('roles.index', 'Roles') !!}
                    {!! $navLink('permissions.index', 'Permissions') !!}
                    @can('view Users')
                    {!! $navLink('users.index', 'Users') !!}
                    @endcan
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-800 transition-colors focus:outline-none">
                            <div class="w-7 h-7 bg-white text-gray-900 rounded-full flex items-center justify-center font-bold text-xs uppercase">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-800 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-800">
        <div class="px-4 pt-3 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-white text-gray-900' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">Dashboard</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('products.index') ? 'bg-white text-gray-900' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">Products</a>
            <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('categories.index') ? 'bg-white text-gray-900' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">Categories</a>
            @can('view Slides')
            <a href="{{ route('slides.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('slides.index') ? 'bg-white text-gray-900' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">Slides</a>
            @endcan
            <a href="{{ route('roles.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('roles.index') ? 'bg-white text-gray-900' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">Roles</a>
            <a href="{{ route('permissions.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('permissions.index') ? 'bg-white text-gray-900' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">Permissions</a>
            @can('view Users')
            <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('users.index') ? 'bg-white text-gray-900' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">Users</a>
            @endcan
        </div>

        <div class="pt-4 pb-3 border-t border-gray-700 px-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 bg-white text-gray-900 rounded-full flex items-center justify-center font-bold text-sm uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-medium text-white text-sm">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-400">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-700">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-700">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
