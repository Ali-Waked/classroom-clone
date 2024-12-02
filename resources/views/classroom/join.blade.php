<x-layout>
    <x-slot:nav-title>
        <strong>Join your class</strong>
    </x-slot:nav-title>
    <section class="join">
        <div class="header">
            <div class="img">
                <img src="{{ asset('assets/images/classroom.png') }}" alt="">
            </div>
            <div class="title">
                <span>Google</span> Classroom
            </div>
            <div class="info">
                <p>
                    Classroom helps classes commulcate save time, and stay orgartized. <a href="">Learn more</a>
                </p>
            </div>
        </div>
        <div class="body">
            <div class="user">
                <div class="img">
                    <img src="{{ Auth::user()->avatar_logo }}" alt="">
                </div>
                <div class="info">
                    <div class="name">{{Auth::user()->name}}</div>
                    <div class="email">{{Auth::user()->email}}</div>
                </div>
            </div>
            <p>You are joing the class as {{$type}}.</p>
            <form action="{{$type == \App\Enums\UserRole::TEACHER->value ?URL::signedRoute('classroom.join',['classroom' => $classroom->id,'role' => \App\Enums\UserRole::TEACHER->value]):URL::signedRoute('classroom.join',['classroom' => $classroom->id])}}" method="post" id="form-join-classroom">
                @csrf
                <button type="submit">Join class</button>
                <input type="hidden" name="role" value="student">
            </form>
        </div>
        <div class="footer">
            By joing, you agree to stare contact information with people in your class. <a href="">Learn more</a>
        </div>
    </section>
</x-layout>
