<x-layout>
    <div class="mx-auto mt-10 w-full max-w-md px-4 pb-12 sm:mt-14">
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

            <h1 class="text-3xl font-bold tracking-tight text-[#2d2d2d]">
                Sign in
            </h1>

            <p class="mt-2 mb-8 text-sm leading-6 text-gray-600">
                Welcome back. Sign in to continue to your account.
            </p>

            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <x-inputs.text
                    id="email"
                    name="email"
                    type="email"
                    label="Email address"
                    placeholder="Enter your email address"
                    :required="true"
                />

                <x-inputs.text
                    id="password"
                    name="password"
                    type="password"
                    label="Password"
                    placeholder="Enter your password"
                    :required="true"
                />

                <button
                    type="submit"
                    class="mt-2 flex h-12 w-full items-center justify-center rounded-lg bg-[#2557a7] px-5 text-base font-bold text-white transition-colors duration-200 hover:bg-[#164081] focus:outline-none focus:ring-2 focus:ring-[#2557a7] focus:ring-offset-2"
                >
                    Sign in
                </button>

                <div class="my-6 flex items-center gap-4">
                    <div class="h-px flex-1 bg-gray-200"></div>
                    <span class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        New to Indeed?
                    </span>
                    <div class="h-px flex-1 bg-gray-200"></div>
                </div>

                <a
                    href="{{ url('/register-type') }}"
                    class="flex h-12 w-full items-center justify-center rounded-lg border border-[#2557a7] bg-white px-5 text-base font-semibold text-[#2557a7] transition-colors duration-200 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-[#2557a7] focus:ring-offset-2"
                >
                    Create an account
                </a>
            </form>
        </div>
    </div>
</x-layout>
