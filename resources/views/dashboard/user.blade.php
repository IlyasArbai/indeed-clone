<x-layout>
    <section class="mx-auto flex h-[80vh] min-h-0 w-full max-w-7xl flex-col overflow-hidden px-4 py-3 sm:px-6">

        {{-- Dashboard Header --}}
        <div class="mb-3 shrink-0 flex justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900">
                    My dashboard
                </h1>
                <p class="mt-1 text-sm text-neutral-600">
                    Manage your profile and keep track of your job applications.
                </p>
            </div>

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

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-3 shrink-0 rounded-lg border border-red-200 bg-red-50 px-4 py-2.5 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-3 shrink-0 rounded-lg border border-green-200 bg-green-50 px-4 py-2.5 text-sm text-green-800">
                <i class="fa-solid fa-circle-check mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Dashboard Content --}}
        <div class="grid min-h-0 flex-1 grid-cols-1 grid-rows-2 gap-4 overflow-hidden lg:grid-cols-3 lg:grid-rows-1">

            {{-- LEFT: Profile --}}
            <div class="flex min-h-0 flex-col overflow-hidden rounded-xl border border-neutral-200 bg-white lg:col-span-1">

                {{-- Profile Header --}}
                <div class="shrink-0 border-b border-neutral-200 px-5 py-4">
                    <h2 class="text-lg font-bold text-neutral-900">
                        Profile information
                    </h2>
                    <p class="mt-1 text-sm text-neutral-600">
                        Keep your information up to date.
                    </p>
                </div>

                {{-- Scrollable Profile Form --}}
                <form
                    action="{{ route('users.update', $user->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="flex min-h-0 flex-1 flex-col overflow-hidden"
                >
                    @csrf
                    @method('PUT')

                    <div class="min-h-0 flex-1 space-y-4 overflow-y-auto px-5 py-4">

                        {{-- Avatar --}}
                        <div class="flex items-center gap-4">
                            <img
                                src="{{ $user->photo
                                    ? asset('storage/' . $user->photo)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($user->name . ' ' . $user->last_name) . '&background=f0f5ff&color=0164f6' }}"
                                alt="{{ $user->name }}"
                                class="h-16 w-16 shrink-0 rounded-full border border-neutral-200 object-cover"
                            >

                            <div class="min-w-0">
                                <p class="truncate font-semibold text-neutral-900">
                                    {{ $user->name }} {{ $user->last_name }}
                                </p>
                                <p class="mt-1 text-sm text-neutral-600">
                                    <i class="fa-solid fa-location-dot mr-1 text-neutral-400"></i>
                                    {{ $user->city }}
                                </p>
                                <p class="mt-1 text-xs text-neutral-500">
                                    Job seeker
                                </p>
                            </div>
                        </div>

                        <div class="border-t border-neutral-100"></div>

                        {{-- First Name --}}
                        <div>
                            <label for="name" class="mb-1.5 block text-sm font-semibold text-neutral-800">
                                First name
                            </label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name', $user->name) }}"
                                required
                                class="w-full rounded-lg border border-neutral-300 bg-white px-3 py-2.5 text-sm text-neutral-900 outline-none transition placeholder:text-neutral-400 hover:border-neutral-400 focus:border-[#0164f6] focus:ring-2 focus:ring-[#0164f6]/15"
                            >
                        </div>

                        {{-- Last Name --}}
                        <div>
                            <label for="last_name" class="mb-1.5 block text-sm font-semibold text-neutral-800">
                                Last name
                            </label>
                            <input
                                id="last_name"
                                name="last_name"
                                type="text"
                                value="{{ old('last_name', $user->last_name) }}"
                                required
                                class="w-full rounded-lg border border-neutral-300 bg-white px-3 py-2.5 text-sm text-neutral-900 outline-none transition hover:border-neutral-400 focus:border-[#0164f6] focus:ring-2 focus:ring-[#0164f6]/15"
                            >
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-semibold text-neutral-800">
                                Email address
                            </label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email', $user->account->email) }}"
                                required
                                class="w-full rounded-lg border border-neutral-300 bg-white px-3 py-2.5 text-sm text-neutral-900 outline-none transition hover:border-neutral-400 focus:border-[#0164f6] focus:ring-2 focus:ring-[#0164f6]/15"
                            >
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="phone" class="mb-1.5 block text-sm font-semibold text-neutral-800">
                                Phone number
                            </label>
                            <input
                                id="phone"
                                name="phone"
                                type="text"
                                value="{{ old('phone', $user->phone) }}"
                                required
                                class="w-full rounded-lg border border-neutral-300 bg-white px-3 py-2.5 text-sm text-neutral-900 outline-none transition hover:border-neutral-400 focus:border-[#0164f6] focus:ring-2 focus:ring-[#0164f6]/15"
                            >
                        </div>

                        {{-- City --}}
                        <div>
                            <label for="city" class="mb-1.5 block text-sm font-semibold text-neutral-800">
                                City
                            </label>
                            <input
                                id="city"
                                name="city"
                                type="text"
                                value="{{ old('city', $user->city) }}"
                                required
                                class="w-full rounded-lg border border-neutral-300 bg-white px-3 py-2.5 text-sm text-neutral-900 outline-none transition hover:border-neutral-400 focus:border-[#0164f6] focus:ring-2 focus:ring-[#0164f6]/15"
                            >
                        </div>

                        {{-- Bio --}}
                        <div>
                            <label for="bio" class="mb-1.5 block text-sm font-semibold text-neutral-800">
                                About me
                            </label>
                            <textarea
                                id="bio"
                                name="bio"
                                rows="3"
                                placeholder="Tell employers about yourself..."
                                class="w-full resize-y rounded-lg border border-neutral-300 bg-white px-3 py-2.5 text-sm text-neutral-900 outline-none transition placeholder:text-neutral-400 hover:border-neutral-400 focus:border-[#0164f6] focus:ring-2 focus:ring-[#0164f6]/15"
                            >{{ old('bio', $user->bio) }}</textarea>
                        </div>

                        {{-- Profile Photo --}}
                        <div>
                            <label for="photo" class="mb-1.5 block text-sm font-semibold text-neutral-800">
                                Profile photo
                            </label>
                            <input
                                id="photo"
                                name="photo"
                                type="file"
                                accept=".jpg,.jpeg,.png"
                                class="block w-full text-sm text-neutral-600 file:mr-3 file:cursor-pointer file:rounded-md file:border-0 file:bg-[#0164f6]/10 file:px-3 file:py-2 file:font-semibold file:text-[#0164f6] hover:file:bg-[#0164f6]/15"
                            >
                            <p class="mt-1.5 text-xs text-neutral-500">
                                JPG or PNG, maximum 2 MB.
                            </p>
                        </div>

                        {{-- Resume --}}
                        <div>
                            <label for="resume" class="mb-1.5 block text-sm font-semibold text-neutral-800">
                                Resume / CV
                            </label>

                            @if ($user->resume)
                                <a
                                    href="{{ url('/storage/' . $user->resume) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mb-3 inline-flex items-center gap-2 text-sm font-semibold text-[#0164f6] hover:underline"
                                >
                                    <i class="fa-regular fa-file-pdf"></i>
                                    View current resume
                                    <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                </a>
                            @endif

                            <input
                                id="resume"
                                name="resume"
                                type="file"
                                accept=".pdf,application/pdf"
                                class="block w-full text-sm text-neutral-600 file:mr-3 file:cursor-pointer file:rounded-md file:border-0 file:bg-[#0164f6]/10 file:px-3 file:py-2 file:font-semibold file:text-[#0164f6] hover:file:bg-[#0164f6]/15"
                            >
                            <p class="mt-1.5 text-xs text-neutral-500">
                                PDF only, maximum 5 MB.
                            </p>
                        </div>
                    </div>

                    {{-- Pinned Save Button --}}
                    <div class="shrink-0 border-t border-neutral-200 bg-white px-5 py-3">
                        <button
                            type="submit"
                            class="w-full rounded-lg bg-[#0164f6] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#0052cc] focus:outline-none focus:ring-2 focus:ring-[#0164f6] focus:ring-offset-2"
                        >
                            <i class="fa-solid fa-floppy-disk mr-2"></i>
                            Save profile
                        </button>
                    </div>
                </form>
            </div>

            {{-- RIGHT: Statistics and Applications --}}
            <div class="flex min-h-0 flex-col gap-4 overflow-hidden lg:col-span-2">

                {{-- Statistics --}}
                <div class="grid shrink-0 grid-cols-3 gap-3">

                    @foreach ([
                        [
                            'label' => 'Applications',
                            'count' => $stats['total'],
                            'icon' => 'fa-paper-plane',
                        ],
                        [
                            'label' => 'Pending',
                            'count' => $stats['pending'],
                            'icon' => 'fa-clock',
                        ],
                        [
                            'label' => 'Hired',
                            'count' => $stats['hired'],
                            'icon' => 'fa-circle-check',
                        ],
                    ] as $stat)
                        <div class="min-w-0 rounded-xl border border-neutral-200 bg-white px-3 py-4 sm:px-5">
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-xs font-medium text-neutral-600 sm:text-sm">
                                    {{ $stat['label'] }}
                                </p>
                                <i class="fa-solid {{ $stat['icon'] }} hidden text-[#0164f6] sm:inline-block"></i>
                            </div>
                            <p class="mt-2 text-2xl font-bold tracking-tight text-neutral-900 sm:text-3xl">
                                {{ $stat['count'] }}
                            </p>
                        </div>
                    @endforeach

                </div>

                {{-- Applications Card --}}
                <div class="flex min-h-0 flex-1 flex-col overflow-hidden rounded-xl border border-neutral-200 bg-white">

                    {{-- Fixed Applications Header --}}
                    <div class="flex shrink-0 items-center justify-between gap-3 border-b border-neutral-200 px-4 py-4 sm:px-5">
                        <div>
                            <h2 class="text-lg font-bold text-neutral-900">
                                My applications
                            </h2>
                            <p class="mt-1 text-sm text-neutral-600">
                                Track the status of your applications.
                            </p>
                        </div>

                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#0164f6]/10 text-[#0164f6]">
                            <i class="fa-solid fa-briefcase"></i>
                        </span>
                    </div>

                    {{-- Scrollable Applications --}}
                    <div class="min-h-0 flex-1 overflow-y-auto">

                        @forelse ($applicants as $application)
                            @php
                                $statusColor = match ($application->status) {
                                    'pending' => 'border-amber-200 bg-amber-50 text-amber-800',
                                    'hired' => 'border-green-200 bg-green-50 text-green-800',
                                    'rejected' => 'border-red-200 bg-red-50 text-red-800',
                                    default => 'border-neutral-200 bg-neutral-100 text-neutral-700',
                                };
                            @endphp

                            <article class="border-b border-neutral-100 px-4 py-4 transition hover:bg-[#0164f6]/[0.03] sm:px-5">

                                <div class="flex items-start gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-neutral-200 bg-neutral-50 text-[#0164f6]">
                                        <i class="fa-solid fa-briefcase"></i>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <h3 class="break-words font-semibold text-neutral-900">
                                            {{ $application->job->title }}
                                        </h3>

                                        <p class="mt-1 text-xs text-neutral-600 sm:text-sm">
                                            <i class="fa-regular fa-calendar mr-1 text-neutral-400"></i>
                                            Applied {{ $application->created_at->format('M d, Y') }}
                                        </p>

                                        <span class="mt-2 inline-flex items-center gap-1.5 rounded-md border px-2.5 py-1 text-xs font-semibold {{ $statusColor }}">
                                            @if ($application->status === 'pending')
                                                <i class="fa-regular fa-clock"></i>
                                            @elseif ($application->status === 'hired')
                                                <i class="fa-solid fa-circle-check"></i>
                                            @elseif ($application->status === 'rejected')
                                                <i class="fa-solid fa-circle-xmark"></i>
                                            @endif

                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Rejection Reason --}}
                                @if ($application->status === 'rejected' && $application->rejection_reason)
                                    <div class="mt-3 rounded-lg border border-red-100 bg-red-50 px-3 py-2.5">
                                        <p class="text-xs font-semibold text-red-800">
                                            Reason for rejection
                                        </p>
                                        <p class="mt-1 whitespace-pre-line text-sm text-red-700">
                                            {{ $application->rejection_reason }}
                                        </p>
                                    </div>
                                @endif

                                {{-- Cover Letter --}}
                                @if ($application->cover_letter)
                                    <details class="group mt-3">
                                        <summary class="flex cursor-pointer list-none items-center gap-2 text-sm font-semibold text-[#0164f6] hover:underline">
                                            <i class="fa-regular fa-file-lines"></i>
                                            View cover letter
                                            <i class="fa-solid fa-chevron-down ml-auto text-xs transition group-open:rotate-180"></i>
                                        </summary>

                                        <div class="mt-3 rounded-lg border border-neutral-200 bg-neutral-50 p-3">
                                            <p class="whitespace-pre-line text-sm leading-6 text-neutral-700">{{ $application->cover_letter }}</p>
                                        </div>
                                    </details>
                                @endif
                            </article>

                        @empty
                            <div class="flex min-h-64 flex-col items-center justify-center px-6 py-10 text-center">
                                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#0164f6]/10 text-[#0164f6]">
                                    <i class="fa-regular fa-folder-open text-xl"></i>
                                </div>

                                <h3 class="mt-4 font-semibold text-neutral-900">
                                    No applications yet
                                </h3>

                                <p class="mt-2 max-w-xs text-sm leading-5 text-neutral-600">
                                    Your applications will appear here after you apply for a job.
                                </p>

                                <a
                                    href="{{ route('jobs.index') }}"
                                    class="mt-5 inline-flex items-center gap-2 rounded-lg bg-[#0164f6] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#0052cc] focus:outline-none focus:ring-2 focus:ring-[#0164f6] focus:ring-offset-2"
                                >
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    Browse jobs
                                </a>
                            </div>
                        @endforelse

                    </div>

                    {{-- Fixed Pagination --}}
                    @if ($applicants->hasPages())
                        <div class="shrink-0 border-t border-neutral-200 bg-white px-3 py-2 sm:px-5">
                            {{ $applicants->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</x-layout>
