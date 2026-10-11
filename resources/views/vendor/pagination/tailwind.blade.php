
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
         class="flex items-center justify-between gap-3 text-sm">

        {{-- Results count --}}
        <p class="shrink-0 text-xs text-gray-500 sm:text-sm">
            <span class="font-semibold text-gray-800">{{ $paginator->firstItem() ?? 0 }}</span>
            –
            <span class="font-semibold text-gray-800">{{ $paginator->lastItem() ?? 0 }}</span>
            of
            <span class="font-semibold text-gray-800">{{ $paginator->total() }}</span>
        </p>

        {{-- Page navigation --}}
        <div class="flex items-center gap-1">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="flex size-8 cursor-not-allowed items-center justify-center rounded-lg text-gray-300"
                      aria-disabled="true"
                      aria-label="{{ __('pagination.previous') }}">
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   rel="prev"
                   aria-label="{{ __('pagination.previous') }}"
                   class="flex size-8 items-center justify-center rounded-lg text-gray-600 transition hover:bg-blue-50 hover:text-[#0164f6]">
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            @endif

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-1 text-gray-400" aria-hidden="true">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page"
                                  class="flex size-8 items-center justify-center rounded-lg bg-[#0164f6] font-semibold text-white">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                               class="flex size-8 items-center justify-center rounded-lg font-medium text-gray-600 transition hover:bg-blue-50 hover:text-[#0164f6]">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   rel="next"
                   aria-label="{{ __('pagination.next') }}"
                   class="flex size-8 items-center justify-center rounded-lg text-gray-600 transition hover:bg-blue-50 hover:text-[#0164f6]">
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            @else
                <span class="flex size-8 cursor-not-allowed items-center justify-center rounded-lg text-gray-300"
                      aria-disabled="true"
                      aria-label="{{ __('pagination.next') }}">
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </span>
            @endif
        </div>
    </nav>
@endif
