@props([
    'type' => 'text',
    'name',
    'id',
    'label',
    'value' => '',
])
<div class="form-control">
    <input type="{{ $type }}" value="{{ $value }}" id="{{ $id }}" name="{{ $name }}"
        {{ $attributes }}>
    <label for="{{ $id }}">{{ $label }}</label>
    <small>{{ $errors->first($name) }}</small>
</div>
