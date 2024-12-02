<x-layout>
    <x-slot:nav-title>
        <x-nav-title :classroom="$classroom" />
    </x-slot:nav-title>
    <section class="show-classwork container">
        <div class="left">
            <div class="header">
                <div class="head">
                    <div style="display: flex; align-items:center;">
                        <div class="icon">
                            <svg focusable="false" width="24" height="24" viewBox="0 0 24 24" class=" NMm5M hhikbc">
                                <path d="M7 15h7v2H7zm0-4h10v2H7zm0-4h10v2H7z"></path>
                                <path
                                    d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75zM19 19H5V5h14v14z">
                                </path>
                            </svg>
                        </div>
                        <div class="title">Employee Leave Management System</div>
                    </div>
                    <div class="options">
                        <div class="icon">
                            <svg focusable="false" width="24" height="24" viewBox="0 0 24 24" class=" NMm5M">
                                <path
                                    d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                                </path>
                            </svg>
                        </div>
                        <ul class="remove">
                            <li>Copy Link</li>
                        </ul>
                    </div>
                </div>
                <div class="created-by">
                    <div class="name">Ali Abu Waked</div> <sup>.</sup>
                    <div class="date">9 Aug </div>
                    <div class="edited-date"> (Edit 12 Aug)</div>
                </div>
                <div class="points">
                    <div class="point-number">25 points</div>
                    <div class="date">Due 14 Aug</div>
                </div>
            </div>
            <div class="body">
                {!! '<p>hi</p> <h1>Welcome my name is ali</h1> <br/> <span> h</span>' !!}
            </div>
            <div class="class-comment">
                <div class="header">
                    <div class="icon">
                        <svg focusable="false" width="24" height="24" viewBox="0 0 24 24" class=" NMm5M">
                            <path
                                d="M15 8c0-1.42-.5-2.73-1.33-3.76.42-.14.86-.24 1.33-.24 2.21 0 4 1.79 4 4s-1.79 4-4 4c-.43 0-.84-.09-1.23-.21-.03-.01-.06-.02-.1-.03A5.98 5.98 0 0 0 15 8zm1.66 5.13C18.03 14.06 19 15.32 19 17v3h4v-3c0-2.18-3.58-3.47-6.34-3.87zM9 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2m0 9c-2.7 0-5.8 1.29-6 2.01V18h12v-1c-.2-.71-3.3-2-6-2M9 4c2.21 0 4 1.79 4 4s-1.79 4-4 4-4-1.79-4-4 1.79-4 4-4zm0 9c2.67 0 8 1.34 8 4v3H1v-3c0-2.66 5.33-4 8-4z">
                            </path>
                        </svg>
                    </div>
                    <h4>Class Comments</h4>
                </div>
                <div class="button">
                    Add a class comment
                </div>
            </div>
        </div>
        <div class="right">
            <div class="work">
                <div class="your-work">
                    <h3>Your work</h3>
                    <span>Handed in</span>
                </div>
                <iframe src="" frameborder="0"></iframe>
                <button>Unsubmit</button>
            </div>
            <div class="private-comment">
                <div>
                    <div class="icon">
                        <svg focusable="false" width="24" height="24" viewBox="0 0 24 24" class=" NMm5M">
                            <path
                                d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 9c2.7 0 5.8 1.29 6 2v1H6v-.99c.2-.72 3.3-2.01 6-2.01m0-11C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z">
                            </path>
                        </svg>
                    </div>
                    <span>Private Comments</span>
                </div>
                <span>Add Comment To {{$classroom->user->name}}</span>
            </div>
        </div>
    </section>
</x-layout>
