<x-layout>
    <div class="min-h-[90dvh] bg-white">
        {{-- Registration selection --}}
        <main class="px-5 pb-16 pt-12 sm:pt-16">
            <div class="mx-auto max-w-190">

                <div class="mb-9 text-center">
                    <h1 class="text-[28px] font-bold leading-tight tracking-tight text-[#2d2d2d] sm:text-[34px]">
                        Create an account
                    </h1>

                    <p class="mx-auto mt-3 max-w-lg text-base leading-7 text-gray-600">
                        Choose how you want to use Indeed.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- Job seeker --}}
                    <a
                        href="{{ url('/users/create') }}"
                        class="group flex min-h-59 flex-col rounded-xl border border-gray-300 bg-white p-6 transition duration-200 hover:border-[#2557a7] hover:shadow-[0_2px_8px_rgba(0,0,0,0.10)] focus:outline-none focus:ring-2 focus:ring-[#2557a7] focus:ring-offset-2 sm:p-7"
                    >
                        <div class="flex items-center justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-[#eef3fc] text-[#2557a7]">
                                <i class="fa fa-user text-xl"></i>
                            </div>

                            <i class="fa fa-arrow-up-right-from-square text-sm text-gray-400 transition-colors group-hover:text-[#2557a7]"></i>
                        </div>

                        <h2 class="mt-6 text-xl font-bold tracking-tight text-[#2d2d2d]">
                            I'm a job seeker
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-gray-600">
                            Find jobs, build your career, and discover opportunities that fit your skills.
                        </p>

                        <div class="mt-auto flex items-center gap-2 pt-6 text-sm font-semibold text-[#2557a7]">
                            Continue as a job seeker
                            <i class="fa fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                        </div>
                    </a>

                    {{-- Employer --}}
                    <a
                        href="{{ url('/companies/create') }}"
                        class="group flex min-h-59 flex-col rounded-xl border border-gray-300 bg-white p-6 transition duration-200 hover:border-[#2557a7] hover:shadow-[0_2px_8px_rgba(0,0,0,0.10)] focus:outline-none focus:ring-2 focus:ring-[#2557a7] focus:ring-offset-2 sm:p-7"
                    >
                        <div class="flex items-center justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-[#eef3fc] text-[#2557a7]">
                                <i class="fa fa-building text-xl"></i>
                            </div>

                            <i class="fa fa-arrow-up-right-from-square text-sm text-gray-400 transition-colors group-hover:text-[#2557a7]"></i>
                        </div>

                        <h2 class="mt-6 text-xl font-bold tracking-tight text-[#2d2d2d]">
                            I'm an employer
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-gray-600">
                            Post jobs, reach qualified candidates, and find the right people for your team.
                        </p>

                        <div class="mt-auto flex items-center gap-2 pt-6 text-sm font-semibold text-[#2557a7]">
                            Continue as an employer
                            <i class="fa fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                        </div>
                    </a>

                </div>

                <p class="mx-auto mt-8 max-w-lg text-center text-xs leading-5 text-gray-500">
                    By creating an account, you agree to the applicable terms of service and privacy policy.
                </p>

            </div>
        </main>
    </div>
</x-layout>
