<x-layout>

    <section class="setting">
        <div id="show-avatar" class="hidden">
            <div class="overlay" onclick="this.parentNode.classList.add('hidden');"></div>
            <img src="{{ Auth::user()->profile->logo_image }}" alt="">
        </div>
        <div class="profile">
            <h3>{{ __('My Profile') }}</h3>
        </div>
        <div class="avatar">
            <img src="{{ Auth::user()->profile->logo_image }}" id="avatar" alt=""
                onclick="document.getElementById('show-avatar').classList.remove('hidden');">
            <input type="file" hidden name="avatar" id="change_avatar" accept="image/*">
            <label for="change_avatar" type="button">{{ __('Change Profile Picture') }}</label>
        </div>
        <div class="notification">
            <h3>{{ __('Notifications') }}</h3>
            <ul>
                <li>
                    <span class="title">{{ __('Allow Email Notifications') }}
                    </span>
                    <ul>
                        <li>
                            <input type="radio" name="allow_email" id="allow_email" data-allow='true'
                                value="allow_email" @checked(Auth::user()->profile->recive_email_notification)>
                            <label for="allow_email">{{ __('Allow') }}</label>
                        </li>
                        <li>
                            <input type="radio" name="allow_email" data-allow='false' id="not_allow_email"
                                value="not_allow_email" @checked(!Auth::user()->profile->recive_email_notification)>
                            <label for="not_allow_email">{{ __('Not Allow') }}</label>
                        </li>
                    </ul>
                </li>
                <li>
                    <span class="title">{{ __('Allow SMS Notifications') }}
                    </span>
                    <ul>
                        <li>
                            <input type="radio" name="allow_sms" id="allow_sms" data-allow='true' value="allow_sms"
                                @checked(Auth::user()->profile->recive_sms_notification)>
                            <label for="allow_sms">{{ __('Allow') }}</label>
                        </li>
                        <li>
                            <input type="radio" name="allow_sms" id="not_allow_sms" value="not_allow_sms"
                                data-allow='false' @checked(!Auth::user()->profile->recive_sms_notification)>
                            <label for="not_allow_sms">{{ __('Not Allow') }}</label>
                        </li>
                    </ul>
                </li>
                <li>
                    <span class="title">{{ __('Allow Broadcast Notifications') }}
                    </span>
                    <ul>
                        <li>
                            <input type="radio" name="allow_broadcast" data-allow='true' id="allow_broadcast"
                                value="allow_broadcast" @checked(Auth::user()->profile->recive_broadcast_notification)>
                            <label for="allow_broadcast">{{ __('Allow') }}</label>
                        </li>
                        <li>
                            <input type="radio" name="allow_broadcast" data-allow='false' id="not_allow_broadcast"
                                value="not_allow_broadcast" @checked(!Auth::user()->profile->recive_broadcast_notification)>
                            <label for="not_allow_broadcast">{{ __('Not Allow') }}</label>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="notification">
            <h3>{{ __('General') }}</h3>
            <ul>
                <li>
                    <span class="title">{{ __('Localization') }}
                    </span>
                    <ul>
                        <li>
                            <input type="radio" name="localization" id="en" value="en"
                                @checked(Auth::user()->profile->locale == 'en')>
                            <label for="en">{{ __('English') }}</label>
                        </li>
                        <li style="position: relative;left:-8px;z-index: 1;">
                            <input type="radio" name="localization" id="ar" value="ar"
                                @checked(Auth::user()->profile->locale == 'ar')>
                            <label for="ar">{{ __('Arabic') }}</label>
                        </li>
                    </ul>
                </li>
                <li>
                    <span class="title">{{ __('Gender') }}
                    </span>
                    <ul>
                        <li>
                            <input type="radio" name="gender" id="male" value="male"
                                @checked(Auth::user()->profile->gender?->value == 'male')>
                            <label for="male">{{ __('Male') }}</label>
                        </li>
                        <li>
                            <input type="radio" name="gender" id="female" value="female"
                                @checked(Auth::user()->profile->gender?->value == 'female')>
                            <label for="female">{{ __('Female') }}</label>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </section>
    <x-slot:script>
        <script>
            uls = document.querySelectorAll('ul li > span.title + ul');
            document.querySelectorAll('ul li > input[name="allow_broadcast"]').forEach(ele => {
                ele.onclick = function() {
                    updateProfile({
                        'recive_broadcast_notification': ele.dataset.allow == 'true',
                    });
                }
            });
            document.querySelectorAll('ul li > input[name="allow_email"]').forEach(ele => {
                ele.onclick = function() {
                    updateProfile({
                        'recive_email_notification': ele.dataset.allow == 'true',
                    });
                }
            });
            document.querySelectorAll('ul li > input[name="allow_sms"]').forEach(ele => {
                ele.onclick = function() {
                    updateProfile({
                        'recive_sms_notification': ele.dataset.allow == 'true',
                    });
                }
            });
            document.querySelectorAll('input[name="localization"]').forEach(ele => {
                ele.onclick = function() {
                    updateProfile({
                        'locale': ele.value,
                    });
                    href = window.location.href;
                    index = href.indexOf("/{{ Config::get('app.locale') }}/");
                    window.location.href = href.slice(0, index) + `/${ele.value}/` + href.slice(index + 4, href
                        .length);
                }
            });
            document.querySelectorAll('input[name="gender"]').forEach(ele => {
                ele.onclick = function() {
                    updateProfile({
                        'gender': ele.value,
                    });
                }
            });
            document.querySelector('input[name="avatar"]').onchange = function() {
                avatar_image = URL.createObjectURL(this.files[0]);
                const formData = new FormData();
                formData.append('avatar', this.files[0]);
                formData.append('_token', "{{ csrf_token() }}");
                updateProfile('', formData);
                document.querySelector('img#avatar').src = document.querySelector('#show-avatar >img').src = document
                    .querySelector('span.background > img').src = URL
                    .createObjectURL(this.files[0]);
            }

            async function updateProfile(data = '', formData = '') {
                contentType = !data ? '' : {
                    'Content-Type': 'application/json'
                }
                await fetch(`/profile`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            // 'Content-Type': 'application/json',
                            ...contentType,
                        },

                        body: (data ? JSON.stringify({
                            '_token': "{{ csrf_token() }}",
                            ...data
                        }) : formData),
                    }).then(response => response.json())
                    .then(result => {
                        console.log(result, result.request);
                        document.getElementById('aleart-container').innerHTML =
                            `
                    <div class="aleart">{{ __('Update Your Profile Successflly') }}</div>
                    `;
                        setTimeout(() => {
                            document.getElementById('aleart-container').innerHTML = '';
                        }, 5000);
                    })
            }
        </script>
    </x-slot:script>
</x-layout>
