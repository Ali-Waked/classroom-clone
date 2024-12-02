@props([
    'classroom'
])
<a href="{{route('classroom.show',$classroom->id)}}" class="classroom-name">{{Str::ucfirst($classroom->name)}}
    <br>
    {{-- <small>TT9 - PHP Laravel</small> --}}
    <small>{{$classroom->name}}</small>
</a>
