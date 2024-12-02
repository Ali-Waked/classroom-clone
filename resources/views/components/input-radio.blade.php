@props([
    'id',
    'value' => '',
    'checked' => false,
])
<div class="form-control">
    <input type="radio" id="{{$id}}" name="theme" value='{{$value}}' hidden @checked($checked)>
    <label for="{{$id}}">
        <svg focusable="false" width="24" height="24" viewBox="0 0 24 24"
            class="lHagT NMm5M">
            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"></path>
        </svg>
    </label>
</div>