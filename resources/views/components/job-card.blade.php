
@props(['job'])

<div
    data-job-id="{{ $job->id }}"
    {{ $attributes->class([
        'job-card cursor-pointer rounded-xl border-[3px] border-gray-200 bg-white p-4',
        'transition-[border-color,box-shadow,transform] duration-300 ease-out',
        'hover:border-gray-300',
    ]) }}
>
    {{-- Company and title --}}
    <div class="flex items-start gap-3">
        <div class="flex size-12 shrink-0 items-center justify-center rounded-lg bg-gray-100">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6 text-gray-500"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 21h16.5M4.5 3h15v18h-15zM9 6.75h1.5M9 10.5h1.5M9 14.25h1.5M13.5 6.75H15M13.5 10.5H15M13.5 14.25H15"
                />
            </svg>
        </div>

        <div class="min-w-0 flex-1">
            <h3 class="text-base font-semibold leading-5 text-[#0164f6]">
                {{ $job->title }}
            </h3>
            <p class="mt-1 text-sm font-medium text-gray-800">
                {{ $job->company?->name ?? 'Company' }}
            </p>
            <p class="mt-1 text-sm text-gray-600">
                {{ $job->city }}
            </p>
        </div>

        <button
            type="button"
            aria-label="Save {{ $job->title }}"
            @click.stop
            class="shrink-0 rounded-full p-2 text-gray-500 transition hover:bg-blue-50 hover:text-[#0164f6]"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-5"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M17.25 3.75H6.75a1.5 1.5 0 0 0-1.5 1.5v15l6.75-4.5 6.75 4.5v-15a1.5 1.5 0 0 0-1.5-1.5Z"
                />
            </svg>
        </button>
    </div>

    {{-- Salary and job type --}}
    <div class="mt-4 space-y-2">
        @if ($job->salary_min !== null || $job->salary_max !== null)
            <p class="text-sm font-semibold text-gray-900">
                @if ($job->salary_min !== null && $job->salary_max !== null)
                    ${{ number_format($job->salary_min) }} – ${{ number_format($job->salary_max) }}
                @elseif ($job->salary_min !== null)
                    From ${{ number_format($job->salary_min) }}
                @else
                    Up to ${{ number_format($job->salary_max) }}
                @endif

                <span class="font-normal text-gray-500">a month</span>
            </p>
        @endif

        <span class="inline-flex rounded-md bg-gray-100 px-2.5 py-1 text-sm text-gray-700">
            {{ $job->job_type }}
        </span>
    </div>

    {{-- Description --}}
    <p class="mt-3 line-clamp-2 text-sm leading-5 text-gray-700">
        {{ $job->description }}
    </p>

    {{-- Footer --}}
    <div class="mt-4 flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-gray-500">
        <span>
            {{ $job->created_at?->isToday()
                ? 'Posted today'
                : $job->created_at?->diffForHumans()
            }}
        </span>

        <span aria-hidden="true">·</span>

        <span>
            {{ $job->positions_available }}
            {{ Str::plural('position', $job->positions_available) }}
        </span>
    </div>
</div>
