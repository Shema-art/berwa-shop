<!-- Sidebar -->
<div class="flex flex-col w-64 bg-white border-r border-gray-200">
    <div class="flex items-center justify-center h-16 border-b border-gray-200">
        <span class="text-gray-800 font-bold uppercase">{{ config('app.name', 'Laravel') }}</span>
    </div>
    <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex-1 px-2 py-4 bg-white">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                {{ __('Products') }}
            </x-nav-link>
            <x-nav-link :href="route('imports.index')" :active="request()->routeIs('imports.index')">
                {{ __('Imports') }}
            </x-nav-link>
            <x-nav-link :href="route('exports.index')" :active="request()->routeIs('exports.index')">
                {{ __('Exports') }}
            </x-nav-link>
            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Profile') }}
            </x-nav-link>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-nav-link>
            </form>
        </nav>
    </div>
</div> 