<x-mail::message>
# {{ __('Invitation') }}

{{ $content }}

<x-mail::button :url="$url">
{{ $button }}

</x-mail::button>

{{-- Thanks,<br> --}}
<div style="display: flex;align-items:center;column-gap:15px;">
{{-- <img src="{{asset('assets/images/classroom.png')}}" style="width:30px"> --}}
{{ config('app.name') }}
</div>
</x-mail::message>
