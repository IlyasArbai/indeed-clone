@props([
    'id',
    'name',
    'label' => null,
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false
])

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
        type="{{ $type }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        class="h-12 w-full rounded-lg border bg-white px-3 text-base text-[#2d2d2d] placeholder:text-[#767676] transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-1
        @error($name)
            border-red-600 focus:border-red-600 focus:ring-red-600
        @else
            border-[#767676] hover:border-[#2d2d2d] focus:border-[#2557a7] focus:ring-[#2557a7]
        @enderror"
    />

    @error($name)
        <p class="mt-2 text-sm font-medium text-red-700">
            {{ $message }}
        </p>
    @enderror
</div>
