@props (['url','active','mobile' => null])

@if ($mobile)
    <a
        href="{{$url}}"
        class="block px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-200 {{$active ? 'bg-blue-50 text-[#2164f3] font-semibold' : 'text-gray-700 hover:bg-gray-50 hover:text-[#2164f3]'}}"
    >
        {{$slot}}
    </a>
@else
    <a
        href="{{$url}}"
        class="inline-flex items-center border-b-2 py-2 text-sm font-medium transition-colors duration-200 {{$active ? 'border-[#0164f6] text-[#0164f6] font-semibold' : 'border-transparent text-gray-700 hover:border-gray-300 hover:text-[#2164f3]'}}"
    >
        {{$slot}}
    </a>
@endif
