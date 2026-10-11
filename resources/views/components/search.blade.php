
<form
    method="GET"
    action="{{ url('/jobs') }}"
    class="flex w-full justify-center"
>
    <div
        class="flex w-full max-w-xl items-center gap-1 rounded-3xl border-gray-200 bg-white shadow-sm h-15 border"
    >
        <!-- Job title search -->
        <div
            class="flex min-w-0 flex-1 items-center rounded-3xl ring-0 transition-shadow focus-within:ring-3 focus-within:ring-[#2557a7] h-full"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="ml-3 h-5 w-5 shrink-0 text-gray-500"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <circle cx="11" cy="11" r="7" />
                <path
                    stroke-linecap="round"
                    d="m16 16 4 4"
                />
            </svg>

            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Job title, keywords, or company"
                class="w-full min-w-0 border-0 bg-transparent px-3 py-3 text-sm text-gray-900 outline-none focus:border-0 focus:outline-none focus:ring-0 placeholder:text-gray-500"
            />
        </div>

        <!-- Vertical divider -->
        <div class="h-8 w-px shrink-0 bg-gray-200"></div>

        <div
            class="flex min-w-0 flex-1 items-center rounded-3xl ring-0 transition-shadow focus-within:ring-3 focus-within:ring-[#2557a7] h-full"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="ml-2 h-5 w-5 shrink-0 text-gray-500"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"
                />
                <circle cx="12" cy="10" r="2.5" />
            </svg>

            <input
                type="text"
                name="l"
                placeholder="City or region"
                value="{{ request('l') }}"
                class="w-full min-w-0 border-0 bg-transparent px-3 py-3 text-sm text-gray-900 outline-none focus:border-0 focus:outline-none focus:ring-0 placeholder:text-gray-500"
            />
        </div>
        <div class="p-3">
            <button
                type="submit"
                class="shrink-0 rounded-2xl bg-[#0164f6] px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-[#164081] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#2557a7] shadow-2xl"
            >
                Search
            </button>
        </div>

    </div>
</form>

