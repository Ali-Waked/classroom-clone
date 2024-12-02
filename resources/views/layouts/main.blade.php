<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100&display=swap"
        rel="stylesheet">
    @stack('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/froala-editor@3.2.2/css/froala_editor.pkgd.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/froala-editor@3.2.2/css/froala_style.min.css">
    <style>
        :root {
            --main-color: transparent;
            --main-background-color: transparent;
        }
    </style>
    @if (Config::get('app.locale') == 'ar')
        @vite(['resources/css/ar_style.css'])
    @else
        @vite(['resources/css/style.css'])
    @endif
    @vite('resources/js/editor.js')
</head>

<body style="">
    <nav id="nav" class="">
        <div class="container nav-container">
            <div class="left-side">
                <span class="background" id="show-setting">
                    <svg width="24" height="24" viewBox="0 0 24 24" focusable="false" class=" NMm5M">
                        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
                    </svg>
                </span>
                @if (isset($navTitle))
                    {{ $navTitle }}
                @else
                    <div class="google" style="direction: ltr">
                        <span style="color: #4285f4;">G</span>
                        <span style="color: #ea4335;">o</span>
                        <span style="color: #fbbc05;">o</span>
                        <span style="color: #4285f4;">g</span>
                        <span style="color: #34a853;">l</span>
                        <span style="color: #ea4335;">e</span>
                    </div>
                    <strong>{{ __('Classroom') }}</strong>
                @endif
            </div>
            {{ $navLinks ?? '' }}
            <div class="rigth-side">
                {{-- <span class="background"
                onclick="document.getElementById('class-type').classList.toggle('hidden');"><svg focusable="false"
                width="24" height="24" viewBox="0 0 24 24" class=" NMm5M">
                <path d="M20 13h-7v7h-2v-7H4v-2h7V4h2v7h7v2z"></path>
            </svg>
                    <div class="class-type hidden" id="class-type">
                        <ul>
                            <li>
                                <a href="">Join class</a>
                            </li>
                            <li>
                                <a
                                onclick="document.getElementById('create-classroom').classList.remove('cancle-create-class')">Create
                                class</a>
                            </li>
                        </ul>
                    </div>
                </span> --}}
                {{ $navIcon ?? '' }}
                <span class="background"><svg class="gb_h" focusable="false" viewBox="0 0 24 24">
                        <path
                            d="M6,8c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM12,20c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM6,20c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM6,14c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM12,14c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM16,6c0,1.1 0.9,2 2,2s2,-0.9 2,-2 -0.9,-2 -2,-2 -2,0.9 -2,2zM12,8c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM18,14c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2zM18,20c1.1,0 2,-0.9 2,-2s-0.9,-2 -2,-2 -2,0.9 -2,2 0.9,2 2,2z">
                        </path>
                    </svg>

                </span>
                @auth
                    <span class="background"
                        onclick="let a = document.createElement('a'); a.setAttribute('href',`{{ route('profile') }}`); a.click()"><img
                            src="{{ Auth::user()->avatar_logo }}" alt=""></span>
                @endauth
            </div>
        </div>
    </nav>

    {{ $slot }}

    <x-side-links />
    <div id="aleart-container" class="container">
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/froala-editor@3.2.2/js/froala_editor.pkgd.min.js"></script>
    <script>
        const csrf_token = "{{ csrf_token() }}";
        setLocale();

        function setLocale() {
            href = window.location.href;
            ar_index = href.indexOf("/ar/");
            en_index = href.indexOf("/en/");
            if ((ar_index == -1) && ("{{ LaravelLocalization::getCurrentLocale() }}" == 'ar')) {
                window.location.href = href.slice(0, en_index) + `/ar/` + href
                    .slice(en_index + 4, href
                        .length);
                console.log('ar');
            } else if ((en_index == -1) && ("{{ LaravelLocalization::getCurrentLocale() }}" == 'en')) {
                window.location.href = href.slice(0, ar_index) + `/en/` + href
                    .slice(ar_index + 4, href
                        .length);
            }
        }

        function archivedClassroom(e) {
            // console.log(e.dataset.id);
            form = document.createElement('form');
            csrf_input = document.createElement('input');
            method_input = document.createElement('input');
            type = document.createAttribute('type');
            type.value = 'hidden';
            form.setAttribute('method', 'post');
            form.setAttribute('action', `/classrooms/${e.dataset.id}`);
            csrf_input.setAttribute('name', '_token');
            csrf_input.setAttribute('value', "{{ csrf_token() }}");
            csrf_input.setAttributeNode(type);
            method_input.setAttribute('name', '_method');
            method_input.setAttribute('value', 'delete');
            method_input.setAttribute('type', 'hidden');
            form.appendChild(csrf_input);
            form.appendChild(method_input);
            // console.log(form);
            document.body.appendChild(form);
            form.submit();
        }

        function restoreArchivedClassroom(e) {
            // console.log(e.dataset.id);
            form = document.createElement('form');
            csrf_input = document.createElement('input');
            method_input = document.createElement('input');
            type = document.createAttribute('type');
            type.value = 'hidden';
            form.setAttribute('method', 'post');
            form.setAttribute('action', `/classrooms/${e.dataset.id}/trash`);
            csrf_input.setAttribute('name', '_token');
            csrf_input.setAttribute('value', "{{ csrf_token() }}");
            csrf_input.setAttributeNode(type);
            method_input.setAttribute('name', '_method');
            method_input.setAttribute('value', 'put');
            method_input.setAttribute('type', 'hidden');
            form.appendChild(csrf_input);
            form.appendChild(method_input);
            // console.log(form);
            document.body.appendChild(form);
            form.submit();
        }

        function deleteArchivedClassroom(e) {
            // console.log(e.dataset.id);
            form = document.createElement('form');
            csrf_input = document.createElement('input');
            method_input = document.createElement('input');
            type = document.createAttribute('type');
            type.value = 'hidden';
            form.setAttribute('method', 'post');
            form.setAttribute('action', `/classrooms/${e.dataset.id}/force-delete`);
            csrf_input.setAttribute('name', '_token');
            csrf_input.setAttribute('value', "{{ csrf_token() }}");
            csrf_input.setAttributeNode(type);
            method_input.setAttribute('name', '_method');
            method_input.setAttribute('value', 'delete');
            method_input.setAttribute('type', 'hidden');
            form.appendChild(csrf_input);
            form.appendChild(method_input);
            // console.log(form);
            document.body.appendChild(form);
            form.submit();
        }
        if ("{{ session()->has('success') }}") {
            document.getElementById('aleart-container').innerHTML =
                `
            <div class="aleart">{{ session('success') }}</div>
            `;
            setTimeout(() => {
                document.getElementById('aleart-container').innerHTML = '';
            }, 5000);
        }
        [...document.getElementsByClassName('classroom-edit')].forEach(element => {
            element.onclick = function() {
                document.getElementById('edit-classroom').classList.remove('cancle-create-class');
                document.getElementById('edit-classroom').innerHTML = `
                    <div class="overlay" onclick="this.parentNode.classList.add('cancle-create-class')"></div>
                    <form action="/classrooms/${this.dataset.id}" method="post" class="content edit">
                        @csrf
                        @method('put')
                        <h4>Edit class</h4>
                        
                        <x-form-control name='name' value="${this.dataset.name}" id='classroom-edit' label='Class name (required)' />
                        
                        <x-form-control name='section' value="${this.dataset.section}" id='section-edit' label='Section' />
                        
                        <x-form-control name='subject' value="${this.dataset.subject}" id='subject-edit' label='Subject' />
                        
                        <x-form-control name='room' value="${this.dataset.room}" id='room-edit' label='Room' />
                        
                        <div class="buttons">
                            
                            <x-button type='button' label='Cancle'
                            onclick="document.getElementById('edit-classroom').classList.add('cancle-create-class')" />
                            <x-button label='Update' />
                            </div>
                            </form>
                            `;
                inputs = document.querySelectorAll('form.edit .form-control input')
                inputs.forEach(input => {
                    input.onchange = function() {
                        console.log(this.id);
                        inputEditFocous(this);
                    }
                });
                inputs.forEach(e => {
                    inputEditFocous(e);
                })
            }
        });
        document.querySelector('body').onscroll = function() {
            if (window.scrollY <= 67) {
                document.getElementById('nav').classList.remove('nav-scroll');
            } else {
                document.getElementById('nav').classList.add('nav-scroll');
            }
        }

        inputs = document.querySelectorAll('form .form-control input')

        inputs.forEach(input => {
            input.onchange = function() {
                console.log(this.id);
                inputFocous(this);
            }
        });
        inputs.forEach(e => {
            inputFocous(e);
        })

        function inputEditFocous(input) {
            if ((input.id == 'classroom-edit')) {
                if (input.value == '') {
                    document.querySelector('form.edit .buttons button[type="submit"]')
                        .classList.remove('active')
                } else {
                    document.querySelector('form.edit .buttons button[type="submit"]')
                        .classList.add('active')
                }
            } else if ((input.id == 'edit-topic-rename')) {
                if (input.value == '') {
                    console.log('no');
                    document.querySelectorAll('form.edit .buttons button[type="submit"]')[1]
                        .classList.remove('active')
                } else {
                    console.log('wwwowwow')
                    document.querySelectorAll('form.edit .buttons button[type="submit"]')[1]
                        .classList.add('active')
                }
            }
            if (input.value == '') {
                document.querySelector(`form.edit .form-control label[for=${input.id}]`).classList.remove(
                    'active');
                input.classList.remove('active');
            } else {
                document.querySelector(`form.edit .form-control label[for=${input.id}]`).classList.add('active');
                input.classList.add('active');
            }
        }

        function inputFocous(input) {
            if ((input.id == 'classroom')) {
                if (input.value == '') {
                    console.log('no');
                    document.querySelector('form .buttons button[type="submit"]')
                        .classList.remove('active')
                } else {
                    console.log('wwwowwow')
                    document.querySelector('form .buttons button[type="submit"]')
                        .classList.add('active')
                }
            } else if ((input.id == 'topic-rename')) {
                if (input.value == '') {
                    console.log('no');
                    document.querySelectorAll('form .buttons button[type="submit"]')[1]
                        .classList.remove('active')
                } else {
                    console.log('wwwowwow')
                    document.querySelectorAll('form .buttons button[type="submit"]')[1]
                        .classList.add('active')
                }
            }
            if (input.value == '') {
                document.querySelector(`form .form-control label[for=${input.id}]`).classList.remove(
                    'active');
                input.classList.remove('active');
            } else {
                document.querySelector(`form .form-control label[for=${input.id}]`).classList.add('active');
                input.classList.add('active');
            }
        }


        document.getElementById('show-setting').onclick = function() {
            console.log('hi');
            document.querySelector('aside').classList.toggle('desable');
            if (document.body.style.overflowY == 'hidden') {
                document.body.style.overflowY = 'visible';
            } else {
                document.body.style.overflowY = 'hidden';

            }
        }
        // console.log("{{ $errors->any() }}" == false)
        if (window.sessionStorage.getItem('topic') == 'true' && "{{ $errors->any() }}") {
            document.querySelectorAll('div.create-topic')[0].classList.remove('hidden');
        }
        if (window.sessionStorage.getItem('edit-topic') == 'true' && "{{ $errors->any() }}") {
            document.querySelectorAll('div.create-topic')[1].classList.remove('hidden');
        }
    </script>
    {{ $script ?? '' }}
    <script>
        if (window.localStorage.hasOwnProperty('theme')) {
            const root = document.documentElement;
            mainColor = window.localStorage.getItem('theme');
            root.style.setProperty('--main-color', mainColor);
            // root.style.setProperty('--main-color', window.localStorage.getItem('theme'));

            const alphaColor = changeAlpha(mainColor, 0.15);
            // Set the alpha color as a CSS variable
            console.log('hi', alphaColor);
            root.style.setProperty('--main-background-color', alphaColor);

            // Function to change alpha value of a color
            function changeAlpha(hex, alpha) {
                const hexValue = hex.replace('#', '');
                const r = parseInt(hexValue.substring(0, 2), 16);
                const g = parseInt(hexValue.substring(2, 4), 16);
                const b = parseInt(hexValue.substring(4, 6), 16);
                return `rgba(${r}, ${g}, ${b}, ${alpha})`;

                // Calculate the new rgba value
                // const rgba = `rgba(${components[0]}, ${components[1]}, ${components[2]}, ${alpha})`;

                // return rgba;
            }
        }

        function deleteTopic(e) {
            topic = e.dataset.topic;
            classroom = e.dataset.classroom;
            form = document.createElement('form');
            form.setAttribute('action', `/classrooms/${classroom}/${topic}/destroy`);
            form.setAttribute('method', 'post');
            csrf_input = document.createElement('input');
            csrf_input.setAttribute('type', 'hidden');
            csrf_input.setAttribute('value', csrf_token);
            csrf_input.setAttribute('name', '_token');
            method_input = document.createElement('input');
            method_input.setAttribute('type', 'hidden');
            method_input.setAttribute('value', 'delete');
            method_input.setAttribute('name', '_method');
            form.append(csrf_input);
            form.append(method_input);
            e.append(form);
            form.submit();
        }

        function copyJoinLink(e) {
            link = e.dataset.link;
            navigator.clipboard.writeText(link)
            document.getElementById('aleart-container').innerHTML =
                `
            <div class="aleart">Copy Invidation Link</div>
            `;
            setTimeout(() => {
                document.getElementById('aleart-container').innerHTML = '';
            }, 5000);
        }
        // document.querySelector('#form-join-classroom button[type="submit"]').onclick = function () {
        //     this.preventDefault();
        //     const input = document.createElement('input');
        //     input.setAttribute('name','role');
        //     input.setAttribute('type','hidden');
        //     input.setAttribute('value',this.dataset.role);
        //     this.parentNode.submit();
        // }
    </script>
</body>

</html>
