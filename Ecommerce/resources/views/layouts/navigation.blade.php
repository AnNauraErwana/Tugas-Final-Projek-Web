<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                    @if (Route::has('login'))
                                <div class="-mx-3 flex flex-1 justify-end">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-black">
                                            
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-black">
                                            Log in
                                        </a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-black">
                                                Register
                                            </a>
                                        @endif
                                    @endauth
                                </div>
                            @endif 
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                        @if (auth()->check())
                                @if (auth()->user()->role == 'admin')
                                    <x-responsive-nav-link :href="route('admin.dashboard.index')" :active="request()->routeIs('admin.dashboard.index')">
                                        {{ __('Dashboard') }}
                                    </x-responsive-nav-link>
                                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                                        {{ __('User Management') }}
                                    </x-responsive-nav-link>
                                    <x-responsive-nav-link :href="route('admin.stores.index')" :active="request()->routeIs('admin.stores.index')">
                                        {{ __('All Store') }}
                                    </x-responsive-nav-link>
                                @elseif (auth()->user()->role == 'seller')
                                    <x-responsive-nav-link :href="route('seller.dashboard')" :active="request()->routeIs('seller.dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-responsive-nav-link>
                                    <x-responsive-nav-link :href="route('seller.store.index')" :active="request()->routeIs('seller.store.index')">
                                        {{ __('My Store') }}
                                    </x-responsive-nav-link>
                                    <x-responsive-nav-link :href="route('seller.product.index')" :active="request()->routeIs('seller.product.index')">
                                        {{ __('Products') }}
                                    </x-responsive-nav-link>
                                @elseif (auth()->user()->role == 'buyer')
                                    <x-responsive-nav-link :href="route('buyer.dashboard')" :active="request()->routeIs('buyer.dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-responsive-nav-link>
                                @endif
                            @endif
                        </div>
                    </div>

                    

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        @if (auth()->check())
                            @if (auth()->user()->role == 'admin')
                                <!-- Dashboard -->
                                <x-nav-link :href="route('admin.dashboard.index')" :active="request()->routeIs('admin.dashboard.index')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>

                                <!-- User Management -->
                                <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                                    {{ __('User Management') }}
                                </x-nav-link>

                                <!-- All Stores -->
                                <x-nav-link :href="route('admin.stores.index')" :active="request()->routeIs('admin.stores.index')">
                                    {{ __('All Stores') }}
                                </x-nav-link>
                            @elseif (auth()->user()->role == 'seller')
                                <x-nav-link :href="route('seller.dashboard')" :active="request()->routeIs('seller.dashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                                <x-nav-link :href="route('seller.store.index')" :active="request()->routeIs('seller.store.index')">
                                    {{ __('My Store') }}
                                </x-nav-link>
                                <x-nav-link :href="route('seller.product.index')" :active="request()->routeIs('seller.product.index')">
                                    {{ __('Products') }}
                                </x-nav-link>
                            @elseif (auth()->user()->role == 'buyer')
                                <x-nav-link :href="route('buyer.dashboard')" :active="request()->routeIs('buyer.dashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                                <x-nav-link :href="route('buyer.cart.index')" :active="request()->routeIs('buyer.carts.index')">
                                    {{ __('Carts') }}
                                </x-nav-link>
                            @endif
                        @endif
                    </div>
                </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <!-- Show for Guests -->
                        @guest
                            <div>Guest</div>  <!-- Display for unauthenticated users -->
                        @else
                            <div>{{ Auth::user()->name }}</div> <!-- Show name for authenticated users -->
                        @endguest
                    </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<x-dropdown-link :href="route('logout')" 
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    {{ __('Log Out') }}
</x-dropdown-link>


                            
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            @else
                <div class="px-4">
                    <!-- Show something for guests or unauthenticated users -->
                    <div class="font-medium text-base text-gray-800">Guest</div>
                    <div class="font-medium text-sm text-gray-500">Not logged in</div>
                </div>
            @endauth
        </div>

    </div>
</nav>
