@props(['name', 'value', 'id'])

<input type="radio" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
