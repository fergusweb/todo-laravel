<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Will hold the menu values
     */
    public $links = [];

    /**
     * Initialise properties
     */
    public function mount()
    {
        $this->links = [];
        $this->links[] = (object) ['route' => 'home', 'label' => 'Home'];
        $this->links[] = (object) ['route' => 'about', 'label' => 'About'];
        $this->links[] = (object) ['route' => 'contact', 'label' => 'Contact'];
        if (auth()->check()) {
            $this->links[] = (object) ['route' => 'tasks.create', 'label' => 'Create Task'];
        }
        //echo '<pre>', print_r($this->links, true), '</pre>';
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
};
?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @foreach ($links as $link)
                        <x-nav-link :href="route($link->route)" :active="request()->routeIs($link->route)" wire:navigate.hover>
                            {{ $link->label }}
                        </x-nav-link>
                    @endforeach
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (auth()->check())
                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-700">
                                <div
                                    x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                                    x-text="name"
                                    x-on:profile-updated.window="name = $event.detail.name"></div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-nav-link
                        class="text-gray-600 leading-4 font-medium text-sm inline-flex"
                        :href="route('login')"
                        wire:navigate.hover>
                        Login
                    </x-nav-link>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="">

        <div class="pt-2 pb-3 space-y-1">
            @foreach ($links as $link)
                <x-responsive-nav-link :href="route($link->route)" :active="request()->routeIs($link->route)" wire:navigate>
                    {{ $link->label }}
                </x-responsive-nav-link>
            @endforeach

        </div>

        <!-- Responsive Settings Options -->
        @if (auth()->check())
            <div class="pt-4 pb-1 border-t border-gray-200">

                <div class="px-4">

                    <div
                        class="font-medium text-base text-gray-800"
                        x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                        x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name">
                    </div>
                    <div class="font-medium text-sm text-gray-500">
                        {{ auth()->user()->email }}
                    </div>

                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile')" class="!py-0.5 text-sm" wire:navigate>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link class="!py-0.5 text-sm">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @else
            <div class="px-0">
                <x-responsive-nav-link
                    class="text-gray-600 pb-4 leading-4 font-medium inline-flex"
                    :href="route('login')"
                    wire:navigate.hover>
                    Login
                </x-responsive-nav-link>
            </div>
        @endif
    </div>
</nav>
