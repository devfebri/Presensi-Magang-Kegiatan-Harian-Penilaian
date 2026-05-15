@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-gov-primary focus:ring-gov-primary rounded-lg shadow-sm',
]) !!}>
