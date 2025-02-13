<aside class="desable">
    <div class="content">
        <ul class="general">
            <li>
                <a href="{{ route('classroom.index') }}" class="{{ !Route::is('classroom.index') ?: 'active' }}">
                    <svg focusable="false" width="28" height="28" viewBox="0 0 24 24" class=" NMm5M">
                        <path d="M12 3L4 9v12h16V9l-8-6zm6 16h-3v-6H9v6H6v-9l6-4.5 6 4.5v9z"></path>
                    </svg>
                    {{ __('Class') }}
                </a>
            </li>
            <li>
                <a href="">
                    <svg focusable="false" width="28" height="28" viewBox="0 0 24 24" class=" NMm5M">
                        <path
                            d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z">
                        </path>
                    </svg>
                    {{ __('Calendar') }}
                </a>
            </li>
        </ul>
        <ul class="teaching ul-classrooms-link">
            <h5>{{ __('Teaching') }}</h5>
            <li>
                <a href="">
                    <svg enable-background="new 0 0 24 24" focusable="false" height="28" viewBox="0 0 24 24"
                        width="28" class=" NMm5M">
                        <g>
                            <path
                                d="M20,6h-8l-2-2H4C2.9,4,2.01,4.9,2.01,6L2,18c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V8C22,6.9,21.1,6,20,6z M20,18H4V8h16V18z M18,12H6v-2h12V12z M14,16H6v-2h8V16z">
                            </path>
                            <rect fill="none" height="24" width="24"></rect>
                        </g>
                    </svg>
                    {{ __('To review') }}
                </a>
            </li>
            @foreach ($teacherClassrooms as $user)
                <li>
                    <a href="{{ route('classroom.show', $user->classroom->id) }}"
                        class="{{ !(route('classroom.show', $user->classroom->id) == URL::current()) ?: 'active' }}">
                        <span
                            style="background-color:{{ $user->classroom->theme->value }}; text-transform:capitalize;">{{ $user->classroom->name[0] }}</span>
                        {{ $user->classroom->name }}
                    </a>
                </li>
            @endforeach
        </ul>
        <ul class="enrolled ul-classrooms-link">
            <h5>{{ __('Enrolled') }}</h5>
            <li>
                <a href="">
                    <svg enable-background="new 0 0 24 24" focusable="false" height="28" viewBox="0 0 24 24"
                        width="28" class=" NMm5M">
                        <g>
                            <rect fill="none" height="24" width="24"></rect>
                        </g>
                        <g>
                            <g>
                                <path
                                    d="M20,3H4C2.9,3,2,3.9,2,5v14c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V5 C22,3.9,21.1,3,20,3z M20,19H4V5h16V19z"
                                    fill-rule="evenodd"></path>
                                <polygon fill-rule="evenodd"
                                    points="19.41,10.42 17.99,9 14.82,12.17 13.41,10.75 12,12.16 14.82,15">
                                </polygon>
                                <rect fill-rule="evenodd" height="2" width="5" x="5" y="7">
                                </rect>
                                <rect fill-rule="evenodd" height="2" width="5" x="5" y="11">
                                </rect>
                                <rect fill-rule="evenodd" height="2" width="5" x="5" y="15">
                                </rect>
                            </g>
                        </g>
                    </svg>
                    {{ __('To do') }}
                </a>
            </li>
            @foreach ($studentClassrooms as $user)
                <li>
                    <a href="{{ route('classroom.show', $user->classroom->id) }}"
                        class="{{ !(route('classroom.show', $user->classroom->id) == URL::current()) ?: 'active' }}">
                        <span
                            style="background-color:{{ $user->classroom->theme->value }}; text-transform:capitalize;">{{ $user->classroom->name[0] }}</span>
                        {{ $user->classroom->name }}
                    </a>
                </li>
            @endforeach
        </ul>
        <hr style="opacity:0.3;margin-top:10px;margin-bottom:10px;">
        <ul class="setting">
            <li>
                <a href="{{ route('classroom.trashed') }}" class="{{ !Route::is('classroom.trashed') ?: 'active' }}">
                    <svg focusable="false" width="28" height="28" viewBox="0 0 24 24" class=" NMm5M">
                        <path
                            d="M20.54 5.23l-1.39-1.68C18.88 3.21 18.47 3 18 3H6c-.47 0-.88.21-1.16.55L3.46 5.23C3.17 5.57 3 6.02 3 6.5V19c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6.5c0-.48-.17-.93-.46-1.27zM6.24 5h11.52l.83 1H5.42l.82-1zM5 19V8h14v11H5zm11-5.5l-4 4-4-4 1.41-1.41L11 13.67V10h2v3.67l1.59-1.59L16 13.5z">
                        </path>
                    </svg>
                    {{ __('Archived classes') }}
                </a>
            </li>
            <li style="margin-bottom:10px;">
                <a href="{{ route('profile') }}"  class="{{ !Route::is('profile') ?: 'active' }}">
                    <svg focusable="false" width="28" height="28" viewBox="0 0 24 24" class=" NMm5M">
                        <path
                            d="M13.85 22.25h-3.7c-.74 0-1.36-.54-1.45-1.27l-.27-1.89c-.27-.14-.53-.29-.79-.46l-1.8.72c-.7.26-1.47-.03-1.81-.65L2.2 15.53c-.35-.66-.2-1.44.36-1.88l1.53-1.19c-.01-.15-.02-.3-.02-.46 0-.15.01-.31.02-.46l-1.52-1.19c-.59-.45-.74-1.26-.37-1.88l1.85-3.19c.34-.62 1.11-.9 1.79-.63l1.81.73c.26-.17.52-.32.78-.46l.27-1.91c.09-.7.71-1.25 1.44-1.25h3.7c.74 0 1.36.54 1.45 1.27l.27 1.89c.27.14.53.29.79.46l1.8-.72c.71-.26 1.48.03 1.82.65l1.84 3.18c.36.66.2 1.44-.36 1.88l-1.52 1.19c.01.15.02.3.02.46s-.01.31-.02.46l1.52 1.19c.56.45.72 1.23.37 1.86l-1.86 3.22c-.34.62-1.11.9-1.8.63l-1.8-.72c-.26.17-.52.32-.78.46l-.27 1.91c-.1.68-.72 1.22-1.46 1.22zm-3.23-2h2.76l.37-2.55.53-.22c.44-.18.88-.44 1.34-.78l.45-.34 2.38.96 1.38-2.4-2.03-1.58.07-.56c.03-.26.06-.51.06-.78s-.03-.53-.06-.78l-.07-.56 2.03-1.58-1.39-2.4-2.39.96-.45-.35c-.42-.32-.87-.58-1.33-.77l-.52-.22-.37-2.55h-2.76l-.37 2.55-.53.21c-.44.19-.88.44-1.34.79l-.45.33-2.38-.95-1.39 2.39 2.03 1.58-.07.56a7 7 0 0 0-.06.79c0 .26.02.53.06.78l.07.56-2.03 1.58 1.38 2.4 2.39-.96.45.35c.43.33.86.58 1.33.77l.53.22.38 2.55z">
                        </path>
                        <circle cx="12" cy="12" r="3.5"></circle>
                    </svg>
                    {{ __('Settings') }}
                </a>
            </li>
            @auth
                
            <li style="margin-bottom:10px;">
                <a>
                    <form action="{{route('logout')}}" method="post" class="logout">
                        @csrf
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span onclick="this.parentNode.submit()">{{ __('logout') }}</span>
                    </form>
                </a>
            </li>
            @endauth
        </ul>
    </div>
    <div class="other-side" id="close-setting"
        onclick="this.parentNode.classList.add('desable'); document.body.style.overflowY='visible';">
    </div>
</aside>
