<div class="relative" x-data="{ open: false }">

    {{-- Profile trigger --}}
    <button
        type="button"
        @click="open = !open"
        @click.outside="open = false"
        :aria-expanded="open"
        aria-label="Open profile menu"
        class="flex items-center gap-2 rounded-full transition focus:outline-none focus:ring-2 focus:ring-[#2557a7] focus:ring-offset-2"
    >
        @if (Auth::user()->isUser() || Auth::user()->isCompany())
            <img
                src="{{ Auth::user()->data->photo ? asset('storage/' . Auth::user()->data->photo) : asset('storage/photos/default.png') }}"
                alt="Account photo"
                class="h-10 w-10 rounded-full border border-gray-200 object-cover"
            />
        @endif

        <svg
            class="h-4 w-4 text-gray-600 transition-transform duration-200"
            :class="{ 'rotate-180': open }"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m19 9-7 7-7-7"
            />
        </svg>
    </button>

    {{-- Dropdown menu --}}
    <div
        x-cloak
        x-show="open"
        @click.outside="open = false"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 top-full z-50 mt-3 w-64 origin-top-right rounded-xl border border-gray-200 bg-white p-2 text-[#2d2d2d] shadow-lg"
    >
        {{-- User information --}}
        <div class="flex items-center gap-3 rounded-lg p-3">
            @if (Auth::user()->isUser() || Auth::user()->isCompany())
                <img
                    src="{{ Auth::user()->data->photo ? asset('storage/' . Auth::user()->data->photo) : asset('storage/photos/default.png') }}"
                    alt="Account photo"
                    class="h-11 w-11 shrink-0 rounded-full border border-gray-200 object-cover"
                />
            @endif

            <div class="min-w-0">
                <p class="truncate text-sm font-semibold">
                    {{ auth()->user()->name }}
                </p>

                <p class="truncate text-xs text-gray-500">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>

        <div class="my-2 border-t border-gray-200"></div>

        {{-- Navigation --}}
        <a
            href="#"
            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-blue-50 hover:text-[#2557a7]"
        >
            <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.1a7.5 7.5 0 0 1 15 0A17.9 17.9 0 0 1 12 21.75c-2.7 0-5.25-.6-7.5-1.65Z" />
            </svg>
            Profile
        </a>

        <a
            href="#"
            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-blue-50 hover:text-[#2557a7]"
        >
            <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M10.5 6h9m-9 6h9m-9 6h9M4.5 6h.008v.008H4.5V6Zm0 6h.008v.008H4.5V12Zm0 6h.008v.008H4.5V18Z" />
            </svg>
            Settings
        </a>

        <div class="my-2 border-t border-gray-200"></div>

        {{-- Logout --}}
        <form method="POST" action="{{ url('/logout') }}">
            @csrf

            <button
                type="submit"
                class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm font-medium text-red-600 transition hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500"
            >
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3-3H9.75m0 0 3-3m-3 3 3 3" />
                </svg>
                Sign out
            </button>
        </form>
    </div>
</div>
