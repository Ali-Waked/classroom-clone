<x-layout>
    <x-slot:navIcon>
        <span class="background" onclick="document.getElementById('class-type').classList.toggle('hidden');"><svg
                focusable="false" width="24" height="24" viewBox="0 0 24 24" class=" NMm5M">
                <path d="M20 13h-7v7h-2v-7H4v-2h7V4h2v7h7v2z"></path>
            </svg>
            <div class="class-type hidden" id="class-type">
                <ul>
                    <li>
                        <a href="">{{ __('Join class') }}</a>
                    </li>
                    <li>
                        <a
                            onclick="document.getElementById('create-classroom').classList.remove('cancle-create-class')">{{ __('Create class') }}</a>
                    </li>
                </ul>
            </div>
        </span>
        <span class="notification background" style="::after{content:'hidild'}">
            <i class="fa-regular fa-bell"
                onclick="document.getElementById('ul-notification').classList.toggle('remove')"></i>
            <ul class="notification remove" id="ul-notification">
                @foreach (Auth::user()->notifications->take(3) as $notify)
                    {{-- @dd($notify->data) --}}
                    <li class=" {{ $notify->read() ?: 'unread' }}" data-notify-id="{{ $notify->id }}"
                        onclick="notify(this)" data-link="{{ $notify->data['link'] }}">
                        {{ $notify->data['body'] }}
                    </li>
                @endforeach
                {{-- <li>
                    hellow
                </li>
                <li>
                    <b>name</b>
                </li> --}}
            </ul>
            @if (Auth::user()->unreadNotifications->count())
                <span class="disc"></span>
            @endif
        </span>
    </x-slot:navIcon>

    {{-- classrooms --}}
    <div class="container">
        <div class="cards">
            @forelse ($classrooms as $i => $classroom)
                <x-card :classroom="$classroom" :index="$i" />
            @empty
            @endforelse
        </div>
    </div>

    {{-- create classroom --}}
    <div class="create-classroom {{ $errors->any() ? '' : 'cancle-create-class' }}" id="create-classroom">
        <div class="overlay" onclick="this.parentNode.classList.add('cancle-create-class')"></div>
        <form action="{{ route('classroom.store') }}" method="post" class="content">
            @csrf
            <h4>{{ __('Create class') }}</h4>

            <x-form-control name='name' value="{{ old('name') }}" id='classroom'
                label="{{ __('Class name (required)') }}" />

            <x-form-control name='section' value="{{ old('section') }}" id='section' label="{{ __('Section') }}" />

            <x-form-control name='subject' value="{{ old('subject') }}" id='subject' label="{{ __('Subject') }}" />

            <x-form-control name='room' value="{{ old('room') }}" id='room' label="{{ __('Room') }}" />

            <div class="buttons">

                <x-button type='button' label="{{ __('Cancle') }}"
                    onclick="document.getElementById('create-classroom').classList.add('cancle-create-class')" />
                <x-button label="{{ __('Create') }}" />
            </div>
        </form>
    </div>

    <div class="create-classroom {{ $errors->any() ? '' : 'cancle-create-class' }}" id="edit-classroom">

    </div>
    <x-slot:script>
        <script>
            window.localStorage.setItem('theme', '#1111dbd1');

            function notify(e) {
                let a = document.createElement('a');
                let url = new URL(e.dataset.link);
                url.searchParams.append('notify', e.dataset.notifyId);
                a.href = url.href;
                a.click();
            }
        </script>
    </x-slot:script>

</x-layout>
