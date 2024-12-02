@props([
    'type' => 'submit',
    'label',
])
<button type="{{$type}}" {{$attributes}}>{{$label}}</button>
