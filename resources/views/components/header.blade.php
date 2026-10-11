<header
    class="sticky top-0 z-50 bg-white text-gray-800 border-b border-gray-200 shadow-sm"
    x-data="{
        open: false,
    }"
>
    <div class="w-full px-5 sm:px-10 lg:px-20 flex justify-between items-center h-[10dvh]">

        <div class="flex items-center shrink-0">
            <a
                href="{{url('/')}}"
                class="inline-flex items-center rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                <img
                    src="../images/logo.png"
                    alt="Workopia"
                    class="block h-10 sm:h-11 md:h-12 w-auto max-w-45 sm:max-w-55 object-contain"
                />
            </a>
        </div>

        <nav class="hidden md:flex items-center gap-5 lg:gap-7">
            <x-nav-link url="{{url('/jobs')}}" :active="request()->is('jobs')">
                All Jobs
            </x-nav-link>

            <x-nav-link url="{{url('/companies')}}" :active="request()->is('companies')">
                Companies
            </x-nav-link>

            @auth
                <x-nav-link url="{{url('/dashboard')}}" :active="request()->is('dashboard')">
                    Dashboard
                </x-nav-link>
            @else
                <x-nav-link url="{{url('/login')}}" :active="request()->is('login')">
                    Login
                </x-nav-link>

                <x-nav-link url="{{url('/register-type')}}" :active="request()->is('register', 'register-type', 'register-company')">
                    Register
                </x-nav-link>
            @endauth
        </nav>

        <button
            @click="open = !open"
            id="hamburger"
            aria-label="Toggle navigation menu"
            :aria-expanded="open.toString()"
            class="text-gray-700 hover:text-[#2164f3] cursor-pointer md:hidden flex items-center justify-center w-11 h-11 rounded-lg hover:bg-gray-100 active:bg-gray-200 transition duration-200"
        >
            <i class="fa fa-bars text-xl"></i>
        </button>
    </div>

    <nav
        x-show="open"
        @click.away="open = false"
        id="mobile-menu"
        class="md:hidden bg-white border-t border-gray-100 px-4 py-4 space-y-2 shadow-lg"
    >
        <x-nav-link url="{{url('/jobs')}}" :active="request()->is('jobs')" :mobile="true">
            All Jobs
        </x-nav-link>

        @auth
            <x-nav-link
                url="{{url('/saved-jobs')}}"
                :active="request()->is('saved-jobs')"
                :mobile="true"
            >
                Saved Jobs
            </x-nav-link>

            <x-nav-link
                url="{{url('/dashboard')}}"
                :active="request()->is('dashboard')"
                :mobile="true"
            >
                <i class="fa fa-gauge mr-1"></i> Dashboard
            </x-nav-link>

            <x-button-link url="{{url('/jobs/create')}}">Create Job</x-button-link>
        @else
            <x-nav-link url="{{url('/login')}}" :active="request()->is('login')" :mobile="true">
                Login
            </x-nav-link>

            <x-nav-link
                url="{{url('/register')}}"
                :active="request()->is('register')"
                :mobile="true"
            >
                Register
            </x-nav-link>
        @endauth
    </nav>
</header>
