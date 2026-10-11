<x-layout>
    <style>
        [x-cloak] { display: none !important; }

        .company-card-selected {
            animation: company-glow 2s ease-in-out infinite;
        }

        @keyframes company-glow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(1, 100, 246, .08); }
            50% { box-shadow: 0 0 0 4px rgba(1, 100, 246, .12); }
        }
    </style>

    <div
        x-data="{
            selected: {{ $companies->first()?->id ?? 'null' }},
            companies: {{ Illuminate\Support\Js::from(
                $companies->map(fn ($company) => [
                    'id' => $company->id,
                    'name' => $company->name,
                    'phone' => $company->phone,
                    'website' => $company->website,
                    'photo' => $company->photo,
                    'description' => $company->description,
                    'status' => $company->status,
                    'verifiedAt' => $company->verified_at?->format('M d, Y'),
                    'jobsCount' => $company->jobs_count ?? 0,
                    'created' => $company->created_at?->format('M d, Y'),
                ])->values()
            ) }}
        }"
        class="mx-auto flex h-[80dvh] min-h-0 w-full max-w-7xl flex-col overflow-hidden px-4 sm:px-6 lg:px-8"
    >
        {{-- Page heading --}}
        <header class="flex shrink-0 items-center justify-between py-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Companies</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Discover companies and explore their job opportunities.
                </p>
            </div>

            <span class="rounded-full bg-blue-50 px-3 py-1.5 text-sm font-semibold text-[#0164f6]">
                {{ $companies->count() }} companies
            </span>
        </header>

        @if ($companies->isNotEmpty())
            <div class="grid min-h-0 flex-1 grid-cols-1 gap-4 overflow-hidden pb-3 lg:grid-cols-2">

                {{-- LEFT: Company list --}}
                <section class="flex min-h-0 min-w-0 flex-col overflow-hidden rounded-xl border border-gray-200 bg-white">
                    <header class="shrink-0 border-b border-gray-200 px-4 py-3">
                        <h2 class="font-bold text-gray-900">Company directory</h2>
                        <p class="mt-0.5 text-sm text-gray-500">
                            Select a company to see its details.
                        </p>
                    </header>

                    <div class="min-h-0 flex-1 space-y-3 overflow-y-auto p-3">
                        @foreach ($companies as $company)
                            @php
                                $photoExtension = strtolower(
                                    pathinfo($company->photo ?? '', PATHINFO_EXTENSION)
                                );

                                $isImage = in_array($photoExtension, [
                                    'jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'
                                ]);
                            @endphp

                            <button
                                type="button"
                                @click="selected = {{ $company->id }}"
                                :class="selected === {{ $company->id }}
                                    ? 'company-card-selected border-[#0164f6] bg-blue-50/30'
                                    : 'border-gray-200 hover:border-gray-300'"
                                class="flex w-full items-start gap-3 rounded-xl border p-4 text-left transition"
                            >
                                {{-- Company logo --}}
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-gray-200 bg-white">
                                    @if ($company->photo && $isImage)
                                        <img
                                            src="{{ \Illuminate\Support\Facades\Storage::url($company->photo) }}"
                                            alt="{{ $company->name }} logo"
                                            class="h-full w-full object-contain p-1"
                                            loading="lazy"
                                        >
                                    @else
                                        <span class="text-xl font-bold text-[#0164f6]">
                                            {{ strtoupper(substr($company->name, 0, 1)) }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Company information --}}
                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="font-semibold text-gray-900">
                                            {{ $company->name }}
                                        </h3>

                                        @if ($company->status === 'verified')
                                            <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700">
                                                <i class="fa-solid fa-circle-check"></i>
                                                Verified
                                            </span>
                                        @elseif ($company->status === 'pending')
                                            <span class="rounded-full bg-amber-50 px-2 py-0.5 text-xs font-medium text-amber-700">
                                                Pending
                                            </span>
                                        @elseif ($company->status === 'rejected')
                                            <span class="rounded-full bg-red-50 px-2 py-0.5 text-xs font-medium text-red-700">
                                                Rejected
                                            </span>
                                        @else
                                            <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600">
                                                {{ ucfirst($company->status ?? 'Unknown') }}
                                            </span>
                                        @endif
                                    </div>

                                    <p class="mt-1 truncate text-sm text-gray-500">
                                        <i class="fa-solid fa-phone mr-1"></i>
                                        {{ $company->phone ?: 'No phone listed' }}
                                    </p>

                                    <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-500">
                                        <span>
                                            <i class="fa-solid fa-briefcase mr-1"></i>
                                            {{ $company->jobs_count ?? 0 }} jobs
                                        </span>

                                        <span>
                                            <i class="fa-regular fa-calendar mr-1"></i>
                                            {{ $company->created_at?->format('M Y') }}
                                        </span>
                                    </div>
                                </div>

                                <i class="fa-solid fa-chevron-right mt-1 text-xs text-gray-400"></i>
                            </button>
                        @endforeach
                    </div>
                </section>

                {{-- RIGHT: Company details --}}
                <aside class="hidden min-h-0 min-w-0 overflow-y-auto rounded-xl border border-gray-200 bg-white lg:block">
                    <template
                        x-for="company in companies.filter(company => company.id === selected)"
                        :key="company.id"
                    >
                        <article>
                            {{-- Company header --}}
                            <div class="border-b border-gray-200 p-6">
                                <div class="flex items-start gap-4">
                                    <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-gray-50">
                                        <span
                                            class="text-3xl font-bold text-[#0164f6]"
                                            x-text="company.name.charAt(0).toUpperCase()"
                                        ></span>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <h2
                                            class="break-words text-2xl font-bold text-gray-900"
                                            x-text="company.name"
                                        ></h2>

                                        <div class="mt-2 flex flex-wrap items-center gap-2">
                                            <template x-if="company.status === 'verified'">
                                                <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    Verified company
                                                </span>
                                            </template>

                                            <template x-if="company.status === 'pending'">
                                                <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                    Verification pending
                                                </span>
                                            </template>

                                            <template x-if="company.status === 'rejected'">
                                                <span class="rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                                    Verification rejected
                                                </span>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 grid grid-cols-2 gap-3">
                                    <div class="rounded-lg border border-gray-200 p-3">
                                        <i class="fa-solid fa-briefcase text-[#0164f6]"></i>
                                        <p class="mt-2 text-xl font-bold text-gray-900" x-text="company.jobsCount"></p>
                                        <p class="text-xs text-gray-500">Published jobs</p>
                                    </div>

                                    <div class="rounded-lg border border-gray-200 p-3">
                                        <i class="fa-regular fa-calendar text-[#0164f6]"></i>
                                        <p class="mt-2 text-sm font-bold text-gray-900" x-text="company.created || 'N/A'"></p>
                                        <p class="text-xs text-gray-500">Date joined</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Contact information --}}
                            <div class="space-y-6 p-6">
                                <section>
                                    <h3 class="font-bold text-gray-900">About the company</h3>
                                    <p
                                        class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-600"
                                        x-text="company.description || 'No company description provided.'"
                                    ></p>
                                </section>

                                <section>
                                    <h3 class="font-bold text-gray-900">Contact information</h3>

                                    <div class="mt-3 space-y-4">
                                        <div class="flex items-start gap-3">
                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-[#0164f6]">
                                                <i class="fa-solid fa-phone"></i>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-xs text-gray-500">Phone</p>
                                                <p
                                                    class="mt-1 break-words text-sm font-medium text-gray-900"
                                                    x-text="company.phone || 'Not provided'"
                                                ></p>
                                            </div>
                                        </div>

                                        <div class="flex items-start gap-3">
                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-[#0164f6]">
                                                <i class="fa-solid fa-globe"></i>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-xs text-gray-500">Website</p>

                                                <template x-if="company.website">
                                                    <a
                                                        :href="company.website"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        class="mt-1 block break-all text-sm font-medium text-[#0164f6] hover:underline"
                                                        x-text="company.website"
                                                    ></a>
                                                </template>

                                                <template x-if="!company.website">
                                                    <p class="mt-1 text-sm text-gray-500">No website provided</p>
                                                </template>
                                            </div>
                                        </div>

                                        <div class="flex items-start gap-3">
                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-[#0164f6]">
                                                <i class="fa-solid fa-shield-halved"></i>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-xs text-gray-500">Verification</p>

                                                <p
                                                    class="mt-1 text-sm font-medium capitalize text-gray-900"
                                                    x-text="company.status || 'Unknown'"
                                                ></p>

                                                <template x-if="company.verifiedAt">
                                                    <p class="mt-1 text-xs text-gray-500">
                                                        Verified on
                                                        <span x-text="company.verifiedAt"></span>
                                                    </p>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </article>
                    </template>
                </aside>
            </div>
        @else
            {{-- Empty state --}}
            <section class="flex min-h-0 flex-1 items-center justify-center rounded-xl border border-gray-200 bg-white">
                <div class="max-w-md px-6 py-10 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-blue-50 text-[#0164f6]">
                        <i class="fa-solid fa-building text-xl"></i>
                    </div>

                    <h2 class="mt-4 text-xl font-bold text-gray-900">
                        No companies found
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        There are no companies to display right now.
                    </p>
                </div>
            </section>
        @endif
    </div>
</x-layout>
