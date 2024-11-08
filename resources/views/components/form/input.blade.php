@props(['required' => false, 'name' => '', 'label' => '', 'placeholder' => '', 'type' => 'text'])

<div class="col-span-2 {{ $colSpan ?? 'sm:col-span-1' }}">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <input 
        type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
        {{ $required ? 'required' : '' }} />
</div>
