@props(['id', 'name', 'label' => null, 'required' => false])

<div class="mb-5">
    @if($label)
        <label
            class="mb-2 block text-sm font-semibold text-[#2d2d2d]"
            for="{{ $id }}"
        >
            {{ $label }}
            @if($required)
                <span class="text-red-600">*</span>
            @endif
        </label>
    @endif

    <input
        id="{{ $id }}"
        type="file"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
        class="block w-full cursor-pointer rounded-lg border bg-white text-sm text-[#2d2d2d] transition-colors
        file:mr-4 file:cursor-pointer file:border-0 file:border-r file:border-gray-300
        file:bg-gray-50 file:px-4 file:py-3 file:text-sm file:font-semibold file:text-[#2557a7]
        hover:file:bg-blue-50
        @error($name)
            border-red-600 focus:outline-none focus:ring-2 focus:ring-red-500
        @else
            border-[#767676] hover:border-[#2d2d2d] focus:outline-none focus:ring-2 focus:ring-[#2557a7]
        @enderror"
    />

    @error($name)
        <p class="mt-2 text-sm font-medium text-red-700">
            {{ $message }}
        </p>
    @enderror
</div>
