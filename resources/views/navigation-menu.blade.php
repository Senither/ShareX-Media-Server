<nav x-data="{ open: false }" class="bg-white dark:bg-dark-gray-800 border-b border-gray-100 dark:border-dark-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a class="font-medium dark:text-gray-100" href="{{ route('dashboard') }}">
                        {{ app('settings')->get('app.name') }}
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('images') }}" :active="request()->routeIs('images')">
                        {{ __('Images') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('texts') }}" :active="request()->routeIs('texts')">
                        {{ __('Texts') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('files') }}" :active="request()->routeIs('files')">
                        {{ __('Files') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('urls') }}" :active="request()->routeIs('urls')">
                        {{ __('URLs') }}
                    </x-jet-nav-link>

                    @if (request()->user()->is_admin)
                        <x-jet-nav-link href="{{ route('control-panel') }}" :active="request()->routeIs('control-panel')">
                            {{ __('Control Panel') }}
                        </x-jet-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                         src="{{ request()->user()->profile_photo_url }}"
                                         alt="{{ request()->user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-300 dark:hover:text-dark-gray-300 bg-white dark:bg-dark-gray-800 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ request()->user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-dark-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            @if (request()->user()->isImposter())
                                <div class="block px-4 py-2 text-xs text-gray-600 dark:text-dark-gray-300">
                                    {{ __('You can\'t view user-level pages as an imposter') }}
                                </div>
                            @else
                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif
                            @endif

                            <div class="border-t border-gray-100 dark:border-dark-gray-600"></div>

                            @if (request()->user()->isImposter())
                                <x-jet-dropdown-link href="{{ route('imposter.leave') }}">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            @else
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                                         onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-jet-dropdown-link>
                                </form>
                            @endif
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('images') }}" :active="request()->routeIs('images')">
                {{ __('Images') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('texts') }}" :active="request()->routeIs('texts')">
                {{ __('Texts') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('files') }}" :active="request()->routeIs('files')">
                {{ __('Files') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('urls') }}" :active="request()->routeIs('urls')">
                {{ __('URLs') }}
            </x-jet-responsive-nav-link>

            @if (request()->user()->is_admin)
                <x-jet-responsive-nav-link href="{{ route('control-panel') }}" :active="request()->routeIs('control-panel')">
                    {{ __('Control Panel') }}
                </x-jet-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover"
                             src="{{ request()->user()->profile_photo_url }}"
                             alt="{{ request()->user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-dark-gray-400">{{ request()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ request()->user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                @if (request()->user()->isImposter())
                    <div class="block px-4 py-2 text-xs text-gray-600">
                        {{ __('You can\'t view user-level pages as an imposter') }}
                    </div>
                @else
                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-jet-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-jet-responsive-nav-link>
                    @endif
                @endif

                @if (request()->user()->isImposter())
                    <x-jet-responsive-nav-link href="{{ route('imposter.leave') }}">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                @else
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-jet-responsive-nav-link>
                    </form>
                @endif

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', request()->user()->currentTeam->id) }}"
                                               :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (request()->user()->allTeams()
    as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
