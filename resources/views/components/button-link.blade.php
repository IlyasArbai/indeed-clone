@props (['url'])

<a
    href="{{$url}}"
    class="inline-flex items-center justify-center gap-2 bg-[#2164f3] hover:bg-blue-700 text-white text-sm font-semibold px-5 py-3 rounded-lg hover:shadow-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
>
    <i class="fa fa-edit"></i>
    {{$slot}}
</a>
