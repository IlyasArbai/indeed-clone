@props(['type', 'message', 'timeout' => 5000])

@if(session()->has($type))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, {{ $timeout }})"
        x-show="show"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        role="alert"
        class="mb-5 flex items-start gap-3 rounded-lg border p-4 text-sm
        {{ $type === 'success'
            ? 'border-[#b7dfc3] bg-[#eef8f0] text-[#185c37]'
            : 'border-[#f1b8b8] bg-[#fff0f0] text-[#9b1c1c]' }}"
    >
        <div class="mt-0.5 shrink-0">
            @if($type === 'success')
                <i class="fa fa-check-circle text-lg"></i>
            @else
                <i class="fa fa-exclamation-circle text-lg"></i>
            @endif
        </div>

        <p class="flex-1 leading-6 font-medium">
            {{ $message }}
        </p>

        <button
            type="button"
            @click="show = false"
            aria-label="Dismiss alert"
            class="-mr-1 -mt-1 flex h-7 w-7 shrink-0 items-center justify-center rounded-md transition-colors hover:bg-black/5 focus:outline-none focus:ring-2 focus:ring-current"
        >
            <i class="fa fa-times"></i>
        </button>
    </div>
@endif
