<x-layout>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .job-card-selected {
            animation: job-selected-glow 2s ease-in-out infinite;
        }

        @keyframes job-selected-glow {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(1, 100, 246, 0.08);
            }
            50% {
                box-shadow: 0 0 0 4px rgba(1, 100, 246, 0.16);
            }
        }

        .modal-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #d1d5db transparent;
        }
    </style>

    {{-- Header: 10dvh | Search: 15dvh | Content: 70dvh | Footer: 5dvh --}}
    <div
        class="mx-auto flex h-[80dvh] min-h-0 w-full max-w-7xl flex-col overflow-hidden px-4 sm:px-6 lg:px-8"
        @if ($jobs->count() > 0)
            x-data="{
                selected: {{ (int) $jobs->getCollection()->first()->id }},
                showApplyModal: false,
                applyJob: null,
                coverLetter: '',
                jobs: {{ Illuminate\Support\Js::from(
                    $jobs->getCollection()->map(fn ($job) => [
                        'id' => $job->id,
                        'title' => $job->title,
                        'company' => $job->company?->name ?? 'Company',
                        'city' => $job->city,
                        'type' => $job->job_type,
                        'salaryMin' => $job->salary_min,
                        'salaryMax' => $job->salary_max,
                        'description' => $job->description,
                        'requirements' => $job->requirements,
                        'created' => $job->created_at?->diffForHumans(),
                    ])->values()
                ) }}
            }"
            @keydown.escape.window="showApplyModal = false"
        @endif
    >

        {{-- Search Area --}}
        <div class="flex h-[15dvh] shrink-0 items-center overflow-hidden">
            <div class="w-full">
                <x-search />
            </div>
        </div>

        @if ($jobs->count() > 0)

            {{-- Jobs Layout --}}
            <div class="grid min-h-0 flex-1 grid-cols-1 gap-4 overflow-hidden pb-3 lg:grid-cols-2 lg:gap-5">

                {{-- LEFT: Job Results --}}
                <section class="flex min-h-0 min-w-0 flex-col overflow-hidden rounded-xl border border-gray-200 bg-white">

                    <header class="shrink-0 border-b border-gray-200 px-4 py-3">
                        <h1 class="text-lg font-bold text-gray-900">
                            Job results
                        </h1>
                        <p class="mt-0.5 text-sm text-gray-500">
                            {{ $jobs->total() }} jobs found
                        </p>
                    </header>

                    {{-- Scrollable Job Cards --}}
                    <div class="min-h-0 flex-1 overflow-y-auto overscroll-contain p-3">
                        <div class="space-y-3">
                            @foreach ($jobs as $job)
                                <x-job-card
                                    :job="$job"
                                    x-bind:class="selected === {{ (int) $job->id }}
                                        ? 'job-card-selected border-[#0164f6] shadow-[0_4px_18px_rgba(1,100,246,0.10)]'
                                        : 'border-gray-200 hover:border-gray-300'"
                                    @click="selected = {{ (int) $job->id }}"
                                />
                            @endforeach
                        </div>
                    </div>

                    {{-- Fixed Pagination --}}
                    <footer class="shrink-0 overflow-x-auto border-t border-gray-200 bg-white px-3 py-2">
                        <div class="min-w-max">
                            {{ $jobs->links() }}
                        </div>
                    </footer>
                </section>

                {{-- RIGHT: Job Details --}}
                <aside class="hidden min-h-0 min-w-0 overflow-y-auto overscroll-contain rounded-xl border border-gray-200 bg-white lg:block">

                    <template
                        x-for="job in jobs.filter(job => job.id === selected)"
                        :key="job.id"
                    >
                        <article>

                            {{-- Job Header --}}
                            <div class="border-b border-gray-200 p-6">

                                <h2
                                    class="text-2xl font-bold leading-tight text-gray-900"
                                    x-text="job.title"
                                ></h2>

                                <p
                                    class="mt-3 font-semibold text-gray-800"
                                    x-text="job.company"
                                ></p>

                                <p class="mt-1 text-sm text-gray-500">
                                    <i class="fa-solid fa-location-dot mr-1"></i>
                                    <span x-text="job.city"></span>
                                </p>

                                {{-- Salary and Job Type --}}
                                <div class="mt-5 space-y-3">
                                    <p class="font-semibold text-gray-900">
                                        <span
                                            x-text="
                                                job.salaryMin !== null && job.salaryMax !== null
                                                    ? '$' + Number(job.salaryMin).toLocaleString() + ' – $' + Number(job.salaryMax).toLocaleString()
                                                    : job.salaryMin !== null
                                                        ? 'From $' + Number(job.salaryMin).toLocaleString()
                                                        : job.salaryMax !== null
                                                            ? 'Up to $' + Number(job.salaryMax).toLocaleString()
                                                            : 'Salary not listed'
                                            "
                                        ></span>
                                        <span class="text-sm font-normal text-gray-500">
                                            a month
                                        </span>
                                    </p>

                                    <span
                                        class="inline-flex rounded-md bg-gray-100 px-3 py-1 text-sm text-gray-700"
                                        x-text="job.type"
                                    ></span>
                                </div>

                                <p
                                    class="mt-3 text-xs text-gray-500"
                                    x-text="job.created"
                                ></p>

                                @auth
                                    @if (Auth::user()->isUser())
                                        <div class="mt-5 flex flex-wrap gap-3">
                                            <button
                                                type="button"
                                                @click="
                                                    applyJob = job;
                                                    coverLetter = '';
                                                    showApplyModal = true;
                                                "
                                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#0164f6] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-[#0164f6] focus:ring-offset-2"
                                            >
                                                <i class="fa-solid fa-paper-plane"></i>
                                                Apply now
                                            </button>

                                            <button
                                                type="button"
                                                class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:border-gray-400 hover:bg-gray-50"
                                            >
                                                <i class="fa-regular fa-bookmark mr-1.5"></i>
                                                Save job
                                            </button>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                            {{-- Job Description --}}
                            <div class="space-y-6 p-6">
                                <section>
                                    <h3 class="font-bold text-gray-900">
                                        Job description
                                    </h3>
                                    <p
                                        class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-700"
                                        x-text="job.description"
                                    ></p>
                                </section>

                                <section>
                                    <h3 class="font-bold text-gray-900">
                                        Requirements
                                    </h3>
                                    <p
                                        class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-700"
                                        x-text="job.requirements || 'No specific requirements provided.'"
                                    ></p>
                                </section>
                            </div>
                        </article>
                    </template>
                </aside>
            </div>

            {{-- APPLY MODAL --}}
            <div
                x-cloak
                x-show="showApplyModal"
                x-transition.opacity.duration.200ms
                @click.self="showApplyModal = false"
                class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-gray-950/50 p-4 backdrop-blur-[2px]"
                style="display: none;"
            >
                <section
                    x-show="showApplyModal"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="translate-y-3 scale-[0.98] opacity-0"
                    x-transition:enter-end="translate-y-0 scale-100 opacity-100"
                    class="my-auto flex max-h-[90dvh] w-full max-w-xl flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-2xl"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="apply-modal-title"
                    @click.stop
                >

                    {{-- Modal Header --}}
                    <header class="flex shrink-0 items-start justify-between gap-4 border-b border-gray-200 px-5 py-4 sm:px-6">
                        <div class="min-w-0">
                            <div class="mb-2 flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-[#0164f6]">
                                <i class="fa-solid fa-paper-plane"></i>
                                Job application
                            </div>

                            <h2
                                id="apply-modal-title"
                                class="text-xl font-bold text-gray-900"
                            >
                                Apply for this job
                            </h2>

                            <p
                                class="mt-1 break-words text-sm font-semibold text-gray-800"
                                x-text="applyJob?.title"
                            ></p>

                            <p
                                class="mt-1 text-sm text-gray-500"
                                x-text="applyJob?.company + ' · ' + applyJob?.city"
                            ></p>
                        </div>

                        <button
                            type="button"
                            @click="showApplyModal = false"
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#0164f6]"
                            aria-label="Close application modal"
                        >
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </header>

                    {{-- Modal Form --}}
                    <form
                        action="{{ route('applicants.store') }}"
                        method="POST"
                        class="flex min-h-0 flex-1 flex-col overflow-hidden"
                    >
                        @csrf

                        <input
                            type="hidden"
                            name="job_id"
                            :value="applyJob?.id"
                        >

                        {{-- Scrollable Modal Content --}}
                        <div class="modal-scrollbar min-h-0 flex-1 space-y-5 overflow-y-auto px-5 py-5 sm:px-6">

                            {{-- Application Summary --}}
                            <div class="flex gap-3 rounded-lg border border-blue-100 bg-blue-50 p-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-white text-[#0164f6]">
                                    <i class="fa-solid fa-briefcase"></i>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        You're applying for this position
                                    </p>
                                    <p class="mt-1 text-sm leading-5 text-gray-600">
                                        Review the job details and add a cover letter to introduce yourself to the employer.
                                    </p>
                                </div>
                            </div>

                            {{-- Cover Letter --}}
                            <div>
                                <div class="mb-2 flex items-center justify-between gap-3">
                                    <label
                                        for="application_cover_letter"
                                        class="block text-sm font-semibold text-gray-900"
                                    >
                                        Cover letter
                                        <span class="font-normal text-gray-500">(optional)</span>
                                    </label>

                                    <span
                                        class="shrink-0 text-xs text-gray-500"
                                        x-text="coverLetter.length + '/10000'"
                                    ></span>
                                </div>

                                <textarea
                                    id="application_cover_letter"
                                    name="cover_letter"
                                    x-model="coverLetter"
                                    maxlength="10000"
                                    rows="7"
                                    placeholder="Introduce yourself and explain why you're a good fit for this role..."
                                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-3 text-sm leading-6 text-gray-900 outline-none transition placeholder:text-gray-400 hover:border-gray-400 focus:border-[#0164f6] focus:ring-2 focus:ring-[#0164f6]/15"
                                ></textarea>

                                <p class="mt-2 text-xs leading-5 text-gray-500">
                                    Keep it relevant to the position. Your application will be submitted to the employer for review.
                                </p>
                            </div>

                            {{-- Resume Reminder --}}
                            <div class="flex items-start gap-3 rounded-lg border border-gray-200 p-4">
                                <i class="fa-regular fa-file-pdf mt-0.5 text-lg text-[#0164f6]"></i>

                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        Your resume
                                    </p>

                                    @if (auth()->check() && auth()->user()->resume)
                                        <p class="mt-1 text-sm text-gray-600">
                                            You have a resume on your profile.
                                            <a
                                                href="{{ url('/storage/' . auth()->user()->resume) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="font-semibold text-[#0164f6] hover:underline"
                                            >
                                                View resume
                                            </a>
                                        </p>
                                    @else
                                        <p class="mt-1 text-sm leading-5 text-gray-600">
                                            You can add a PDF resume from your profile before applying if the employer needs one.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Fixed Modal Footer --}}
                        <footer class="flex shrink-0 flex-col-reverse gap-3 border-t border-gray-200 bg-gray-50 px-5 py-4 sm:flex-row sm:items-center sm:justify-end sm:px-6">
                            <button
                                type="button"
                                @click="showApplyModal = false"
                                class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300"
                            >
                                Cancel
                            </button>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#0164f6] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-[#0164f6] focus:ring-offset-2"
                            >
                                <i class="fa-solid fa-paper-plane"></i>
                                Submit application
                            </button>
                        </footer>
                    </form>
                </section>
            </div>

        @else

            {{-- Empty State --}}
            <section class="flex min-h-0 flex-1 items-center justify-center overflow-y-auto pb-3">
                <div class="w-full max-w-lg rounded-xl border border-gray-200 bg-white px-6 py-10 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#0164f6]/10 text-[#0164f6]">
                        <i class="fa-solid fa-magnifying-glass text-xl"></i>
                    </div>

                    <h2 class="mt-4 text-xl font-bold text-gray-900">
                        {{ request()->filled('q') || request()->filled('l')
                            ? 'No matching jobs'
                            : 'Find your next opportunity' }}
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                        {{ request()->filled('q') || request()->filled('l')
                            ? "We couldn't find jobs matching your search. Try different keywords or another location."
                            : 'Search by job title, keywords, or location to discover opportunities.' }}
                    </p>

                    @if (request()->filled('q') || request()->filled('l'))
                        <a
                            href="{{ route('jobs.index') }}"
                            class="mt-5 inline-flex rounded-lg bg-[#0164f6] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
                        >
                            Clear search
                        </a>
                    @else
                        <button
                            type="button"
                            onclick="document.querySelector('input[name=q]')?.focus()"
                            class="mt-5 inline-flex rounded-lg bg-[#0164f6] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
                        >
                            Start searching
                        </button>
                    @endif
                </div>
            </section>

        @endif
    </div>
</x-layout>
