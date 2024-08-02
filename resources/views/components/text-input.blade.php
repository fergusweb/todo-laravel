@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'mt-1 p-2 w-full border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500',
]) !!}>
@error($attributes->get('name'))
    <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
@enderror
