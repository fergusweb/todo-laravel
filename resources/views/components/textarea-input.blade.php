@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'rows' => 4,
    'class' => 'mt-1 p-2 w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500',
]) !!}>{{ $slot }}</textarea>
@error($attributes->get('name'))
    <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
@enderror
