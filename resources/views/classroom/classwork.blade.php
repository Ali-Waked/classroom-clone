<x-layout>
    <x-slot:navTitle>
        <x-nav-title :classroom="$classroom" />
    </x-slot:navTitle>
    <x-slot:navLinks>
        <x-nav-links :classroom="$classroom" />
    </x-slot:navLinks>
    <div class="section-container">
        <section class="classwork-section">
            <div class="topics">
                @if ($topics->count())
                    <ul>
                        <li>
                            <a href="" class="active">All topics</a>
                        </li>
                        @foreach ($topics as $id => $name)
                            <li>
                                <a
                                    href="{{ route('classwork.index', ['classroom' => $classroom, 'show' => $id]) }}">{{ $name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="rigth-side">
                <div class="header">
                    @can('create', ['\App\Models\Classwork', $classroom])
                        <div class="create">
                            <a onclick="document.getElementById('options-of-create').classList.toggle('hidden')">
                                <svg focusable="false" width="24" height="24" viewBox="0 0 24 24" class=" NMm5M">
                                    <path d="M20 13h-7v7h-2v-7H4v-2h7V4h2v7h7v2z"></path>
                                </svg>
                                Create</a>
                            <ul id="options-of-create" class="hidden" onclick="this.classList.add('hidden')">
                                <li id="create-classwork-assignment" onclick="active();">
                                    <a onclick="createAssigment(this)">
                                        <svg focusable="false" width="24" height="24" viewBox="0 0 24 24"
                                            class=" NMm5M hhikbc">
                                            <path d="M7 15h7v2H7zm0-4h10v2H7zm0-4h10v2H7z"></path>
                                            <path
                                                d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75zM19 19H5V5h14v14z">
                                            </path>
                                        </svg>
                                        <span>Assignment</span>
                                    </a>
                                </li>
                                <li>
                                    <a onclick="createAssigment(this)">
                                        <svg focusable="false" width="24" height="24" viewBox="0 0 24 24"
                                            class=" NMm5M hhikbc">
                                            <path d="M7 15h7v2H7zm0-4h10v2H7zm0-4h10v2H7z"></path>
                                            <path
                                                d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75zM19 19H5V5h14v14z">
                                            </path>
                                        </svg>
                                        <span>Quiz assignment</span>
                                    </a>
                                </li>
                                <li id="create-classwork-question">
                                    <a onclick="createQuestion(this)">
                                        <svg focusable="false" width="24" height="24" viewBox="0 0 24 24"
                                            class=" NMm5M hhikbc">
                                            <path
                                                d="M19 2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h4l3 3 3-3h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 16H5V4h14v14z">
                                            </path>
                                            <path
                                                d="M11 15h2v2h-2zm1-8c1.1 0 2 .9 2 2 0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4S8 6.79 8 9h2c0-1.1.9-2 2-2z">
                                            </path>
                                        </svg>
                                        <span>Question</span>
                                    </a>
                                </li>
                                <li id="create-classwork-material">
                                    <a onclick="createMaterial(this)">
                                        <svg focusable="false" width="24" height="24" viewBox="0 0 24 24"
                                            class=" NMm5M">
                                            <path
                                                d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H6V4h2v8l2.5-1.5L13 12V4h5v16z">
                                            </path>
                                        </svg>
                                        <span>Material</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <svg focusable="false" width="24" height="24" viewBox="0 0 24 24"
                                            class=" NMm5M">
                                            <path d="M19 5H4v6h2V7h13M5 19h15v-6h-2v4H5"></path>
                                            <path
                                                d="M16.29 10.71l-1.41-1.42L18.17 6l-3.29-3.29 1.41-1.42L21 6zm-8.58 12L3 18l4.71-4.71 1.41 1.42L5.83 18l3.29 3.29z">
                                            </path>
                                        </svg>
                                        <span>Reuse post</span>
                                    </a>
                                </li>
                                <hr>
                                <li
                                    onclick="document.getElementById('create-topic').classList.remove('hidden');this.parentNode.classList.add('hidden');window.sessionStorage.setItem('topic',true);">
                                    <a>
                                        <svg enable-background="new 0 0 24 24" focusable="false" height="24"
                                            viewBox="0 0 24 24" width="24" class=" NMm5M hhikbc">
                                            <rect fill="none" height="24" width="24"></rect>
                                            <path
                                                d="M3,5v14h18V5H3z M7,7v2H5V7H7z M5,13v-2h2v2H5z M5,15h2v2H5V15z M19,17H9v-2h10V17z M19,13H9v-2h10V13z M19,9H9V7h10V9z">
                                            </path>
                                        </svg>
                                        <span>Topic</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endcan
                    <div class="google-options">
                        <div>
                            <svg focusable="false" width="18" height="18" viewBox="0 0 24 24" class=" NMm5M">
                                <path
                                    d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z">
                                </path>
                            </svg>
                            Google Calendar
                        </div>
                        <div>
                            <svg enable-background="new 0 0 24 24" focusable="false" height="18" viewBox="0 0 24 24"
                                width="18" class=" NMm5M">
                                <rect fill="none" height="24" width="24"></rect>
                                <path
                                    d="M14.35,2.5h-4.7c-0.71,0-1.37,0.38-1.73,0.99L1.58,14.4c-0.36,0.62-0.36,1.38-0.01,2l2.35,4.09c0.36,0.62,1.02,1,1.73,1 h12.68c0.72,0,1.38-0.38,1.73-1l2.35-4.09c0.36-0.62,0.35-1.38-0.01-2L16.08,3.49C15.72,2.88,15.06,2.5,14.35,2.5z M18.34,19.5H5.66 l-2.35-4.09L9.65,4.5h4.7l6.34,10.91L18.34,19.5z M12.9,7.75h-1.8l-4.58,7.98L7.25,17h9.5l0.73-1.27L12.9,7.75z M9.25,15L12,10.2 l2.75,4.8H9.25z">
                                </path>
                            </svg>
                            Class Drive Folder
                        </div>
                    </div>
                </div>
                @php
                    $index = 0;
                @endphp
                {{-- @if ($notRatedClasswork->count())
                    <ul class="content" style="margin-bottom: 55px; margin-top:25px">
                        @foreach ($notRatedClasswork as $classwork)
                            <li data-index="{{ $index++ }}">
                                <span>
                                    <div class="icon {{ !$classwork->isActive ?: 'active' }}">
                                        <svg focusable="false" width="24" height="24" viewBox="0 0 24 24"
                                            class=" NMm5M hhikbc">
                                            <path d="M7 15h7v2H7zm0-4h10v2H7zm0-4h10v2H7z"></path>
                                            <path
                                                d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75zM19 19H5V5h14v14z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="name">{{ $classwork->title }}</div>
                                </span>
                                <div class="date">
                                    <span>Due {{ $classwork->created_at->format('j M') }}</span>
                                    <div class="button-material-options">
                                        <svg focusable="false" width="24" height="24" viewBox="0 0 24 24"
                                            class=" NMm5M">
                                            <path
                                                d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <ul class="material-options hidden">
                                    @can('create', ['\App\Models\Classwork', $classroom])
                                        <li onclick="classworkEdit({{ json_encode($classwork) }},this.parentNode.parentNode,this)"
                                            data-topic="" style="padding: 0;">
                                            <a class="edit-classwork" style="padding: 15px 14px;display:block;"
                                                data-description="{{ $classwork->description }}">Edit</a>
                                        </li>
                                        <li onclick="console.log(this.children[0].submit())">
                                            <form
                                                action="{{ route('classwork.destroy', [$classroom->id, $classwork->id]) }}"
                                                method="post" style="display: none">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            Delete
                                        </li>
                                    @endcan
                                    <li>
                                        Copy link
                                    </li>
                                    <hr>
                                    <li class="disable">
                                        Move up
                                    </li>
                                    <li class="disable">
                                        Move down
                                    </li>
                                </ul>
                            </li>
                            @can('create', ['\App\Models\Classwork', $classroom])
                                <div class="classwork-information">
                                    <span>Posted {{ $classwork->created_at->format('H:i') }}</span>
                                    <div class="ins-container">
                                        <div class="instruction">
                                            @if ($classwork->description)
                                                @foreach (json_decode($classwork->description)->blocks as $block)
                                                    @switch($block->type)
                                                        @case('paragraph')
                                                            <p>{!! $block->data->text !!}</p>
                                                        @break

                                                        @case('list')
                                                            @if ($block->data->style == 'unordered')
                                                                <ul style="margin-left: 40px;">
                                                                    @foreach ($block->data->items as $item)
                                                                        <li style="list-style: disc;">{{ $item }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @elseif ($block->data->style == 'ordered')
                                                                <ol style="margin-left: 40px;">
                                                                    @foreach ($block->data->items as $item)
                                                                        <li style="list-style: auto;">{{ $item }}</li>
                                                                    @endforeach
                                                                </ol>
                                                            @endif
                                                        @break

                                                        @case('header')
                                                            <h{{ $block->data->level }}>{{ $block->data->text }}
                                                                </h{{ $block->data->level }}>
                                                            @break

                                                            @default
                                                                <p>hi</p>
                                                        @endswitch
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="numbers">
                                            <div><span>{{ $classwork->number_of_submitted_students }}</span> Handed in
                                            </div>
                                            <div><span>{{ $classwork->number_of_assigned_students }}</span>Assigned</div>
                                        </div>
                                    </div>
                                    <div class="button">
                                        <a href="">View Instructions</a>
                                    </div>
                                </div>
                            @endcan
                        @endforeach
                    </ul>
                @endif --}}
                <ul>
                @if ($classworks->count())
                        @foreach ($classworks as $id => $classwork)
                            <li>
                                @if ($classwork[0]->topic)
                                    <div>
                                        <h2 class="topic-name">{{ Str::ucfirst($classwork[0]->topic->name) }}</h2>
                                        @can('create', ['\App\Models\Topic', $classroom])
                                            <div class="icon button-topic-options">
                                                <svg focusable="false" width="24" height="24" viewBox="0 0 24 24"
                                                    class=" NMm5M">
                                                    <path
                                                        d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <ul>
                                                <ul class="topic-options hidden">
                                                    <li
                                                        onclick="document.getElementById('rename-topic').classList.remove('hidden');this.parentNode.classList.add('hidden');window.sessionStorage.setItem('edit-topic',true);document.getElementById('form-rename-topic').setAttribute('action',`{{ route('topic.update', [$classroom->code, $id]) }}`);document.getElementById('topic-rename').value = `{{ $classwork[0]->topic->name }}`;document.getElementById('topic-rename').classList.add('active');document.querySelector('#topic-rename + label').classList.add('active')">
                                                        Rename
                                                    </li>
                                                    <li onclick="deleteTopic(this)" data-topic="{{ $id }}"
                                                        data-classroom="{{ $classroom->code }}">
                                                        Delete
                                                    </li>
                                                    <li>
                                                        Copy link
                                                    </li>
                                                    <hr>
                                                    <li class="disable">
                                                        Move up
                                                    </li>
                                                    <li class="disable">
                                                        Move down
                                                    </li>
                                                </ul>
                                            </ul>
                                        @endcan
                                    </div>
                                @endif
                                <ul class="content">
                                    @foreach ($classwork as $single_classwork)
                                        {{-- @dd($single_classwork) --}}
                                        <li onclick="sendSubmisstion(this,'{{$single_classwork->users()->where('id',Auth::id())->exists()}}');" data-link="{{route('classwork.show', [$classroom->id, $single_classwork->id])}}">
                                            <span>
                                                <div class="icon {{ !$single_classwork->isActive ?: 'active' }}">
                                                    <svg focusable="false" width="24" height="24"
                                                        viewBox="0 0 24 24" class=" NMm5M hhikbc">
                                                        <path d="M7 15h7v2H7zm0-4h10v2H7zm0-4h10v2H7z"></path>
                                                        <path
                                                            d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75zM19 19H5V5h14v14z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="name">{{ $single_classwork->title }}</div>
                                            </span>
                                            <div class="date">
                                                <span>Due {{ $single_classwork->created_at->format('j M') }}</span>
                                                <div class="button-material-options">
                                                    <svg focusable="false" width="24" height="24"
                                                        viewBox="0 0 24 24" class=" NMm5M">
                                                        <path
                                                            d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <ul class="material-options hidden">
                                                @can('create', ['\App\Models\Classwork', $classroom])
                                                    <li onclick="classworkEdit({{ json_encode($single_classwork) }},this.parentNode.parentNode,this)"
                                                        data-topic="{{ $id }}"style="padding: 0;">
                                                        <a class="edit-classwork"
                                                            style="padding: 15px 14px;display:block;"
                                                            data-description="">Edit</a>
                                                    </li>
                                                    <li onclick="console.log(this.children[0].submit())">
                                                        <form
                                                            action="{{ route('classwork.destroy', [$classroom->id, $single_classwork->id]) }}"
                                                            method="post" style="display: none">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                        Delete
                                                    </li>
                                                @endcan
                                                <li>
                                                    Copy link
                                                </li>
                                                <hr>
                                                <li class="disable">
                                                    Move up
                                                </li>
                                                <li class="disable">
                                                    Move down
                                                </li>
                                            </ul>
                                        </li>
                                        @can('create', ['\App\Models\Classwork', $classroom])
                                            <div class="classwork-information">
                                                <span>Posted {{ $single_classwork->created_at->format('H:i') }}</span>
                                                <div class="ins-container">
                                                    <div class="instruction">
                                                        @if ($single_classwork->description)
                                                            @foreach (json_decode($single_classwork->description)->blocks as $block)
                                                                @switch($block->type)
                                                                    @case('paragraph')
                                                                        <p>{!! $block->data->text !!}</p>
                                                                    @break

                                                                    @case('list')
                                                                        @if ($block->data->style == 'unordered')
                                                                            <ul style="margin-left: 40px;">
                                                                                @foreach ($block->data->items as $item)
                                                                                    <li style="list-style: disc;">
                                                                                        {{ $item }}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @elseif ($block->data->style == 'ordered')
                                                                            <ol style="margin-left: 40px;">
                                                                                @foreach ($block->data->items as $item)
                                                                                    <li style="list-style: auto;">
                                                                                        {{ $item }}</li>
                                                                                @endforeach
                                                                            </ol>
                                                                        @endif
                                                                    @break

                                                                    @case('header')
                                                                        <h{{ $block->data->level }}>{{ $block->data->text }}
                                                                            </h{{ $block->data->level }}>
                                                                        @break

                                                                        @default
                                                                            <p>hi</p>
                                                                    @endswitch
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="numbers">
                                                        <div>
                                                            <span>{{ $single_classwork->users()->wherePivot('status', App\Enums\ClassworkUserStatus::SUBMITTED)->whereNotNull('classwork_user.submitted_at')->count() }}</span>
                                                            Handed in
                                                        </div>
                                                        <div><span>{{ $single_classwork->users()->count() }}</span>Assigned
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button">
                                                    <a href="">View Instructions</a>
                                                </div>
                                            </div>
                                        @endcan
                                    @endforeach
                                </ul>
                            </li>
                            {{-- @dd($topics_without_classworks) --}}
                        @endforeach
                @endif
                @if ($topics_without_classworks->count())
                    @foreach ($topics_without_classworks as $id => $name)
                        <li>
                            <div>
                                <h2 class="topic-name">{{ Str::ucfirst($name) }}</h2>
                                @can('create', ['\App\Models\Topic', $classroom])
                                    <div class="icon button-topic-options">
                                        <svg focusable="false" width="24" height="24" viewBox="0 0 24 24"
                                            class=" NMm5M">
                                            <path
                                                d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <ul>
                                        <ul class="topic-options hidden">
                                            <li
                                                onclick="document.getElementById('rename-topic').classList.remove('hidden');this.parentNode.classList.add('hidden');window.sessionStorage.setItem('edit-topic',true);document.getElementById('form-rename-topic').setAttribute('action',`{{ route('topic.update', [$classroom->code, $id]) }}`);document.getElementById('topic-rename').value = `{{ $name }}`;document.getElementById('topic-rename').classList.add('active');document.querySelector('#topic-rename + label').classList.add('active')">
                                                Rename
                                            </li>
                                            <li onclick="deleteTopic(this)" data-topic="{{ $id }}"
                                                data-classroom="{{ $classroom->code }}">
                                                Delete
                                            </li>
                                            <li>
                                                Copy link
                                            </li>
                                            <hr>
                                            <li class="disable">
                                                Move up
                                            </li>
                                            <li class="disable">
                                                Move down
                                            </li>
                                        </ul>
                                    </ul>
                                @endcan
                            </div>
                        </li>
                    @endforeach
                @endif
                </ul>

                @if (!$classworks->count() && !$topics->count())
                    <div class="not-found">
                        <span>
                            <svg viewBox="0 0 238 134" fill="none" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true" class="bqfGyf">
                                <path
                                    d="M116.595 13.9408L101.654 5.62358C101.655 5.67073 102.784 8.16035 102.784 8.16035L100.904 8.61261L101.563 10.1003L98.3151 10.9611L113.233 19.306C115.108 18.0993 116.398 16.0763 116.595 13.9408Z"
                                    fill="#1E8E3E" class="VnOHwf-Wvd9Cc"></path>
                                <path
                                    d="M98.8805 5.79916C99.2962 6.99028 98.5161 8.26467 97.2788 8.45413L95.2839 5.9474C95.0808 5.68426 95.2792 5.33334 95.6163 5.37946L98.8805 5.79916Z"
                                    fill="#5F6368"></path>
                                <path d="M101.789 5.96962L95.4866 5.6473L98.927 11.0948" stroke="#5F6368"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path
                                    d="M107 103.3L183 103.957V88.5222C183 57.8497 160.068 32.957 131.783 32.957L107.859 42.0865L107 103.3Z"
                                    fill="#DADCE0"></path>
                                <path d="M97 102.957H120V93.9578H106.187C101.098 93.893 97 97.9718 97 102.957Z"
                                    fill="#DADCE0"></path>
                                <path
                                    d="M177.995 92.0402C178.455 91.1595 179.476 91.0085 180.368 91.3213C190.399 94.6613 200.909 91.0111 210.436 88.4643C215.171 87.1736 220.485 85.6947 225.187 88.2578C229.494 90.58 231.915 94.8489 232.363 99.3071C232.802 103.527 232.032 108.713 227.394 110.605C223.46 112.23 219.259 110.748 215.16 110.49C213.065 110.373 211.205 110.631 209.586 111.888C208.091 113.067 206.879 114.418 205.015 115.062C201.129 116.483 197.664 113.669 194.691 111.697C193.958 111.249 193.226 110.802 192.425 110.467C191.792 110.235 191.125 110.06 190.342 110.202C189.322 110.353 188.432 111.049 187.589 111.541C186.405 112.212 185.052 112.78 183.624 112.838C182.14 112.861 180.728 112.385 179.787 111.267C178.979 110.309 178.526 109.025 178.207 107.9C177.404 105.162 177.077 102.405 177.226 99.6292C177.217 99.391 177.355 99.1654 177.458 98.9961C177.541 97.3418 178.064 95.7248 178.983 94.3488C178.926 94.3143 178.836 94.3363 178.779 94.3019C177.921 93.9327 177.637 92.7517 177.995 92.0402Z"
                                    fill="#DADCE0"></path>
                                <path
                                    d="M100.597 31.2005L100.092 27.7059L105.359 26.6501C105.821 24.7988 106.54 21.6134 107.398 19.9604C107.992 18.8364 108.653 17.7785 109.445 16.8529C108.124 12.7535 107.332 9.88448 107.662 5.52069C107.794 4.33056 108.124 3.0082 109.445 2.67761C110.633 2.34702 111.781 2.75907 112.64 3.42025C114.422 4.87485 115.453 5.6789 116.972 7.39797C118.227 8.85257 119.349 10.3733 120.405 12.0262C123.245 11.6295 126.084 11.4312 128.989 11.3651C130.046 11.3651 131.036 11.3651 132.092 11.5634C132.687 7.92692 133.479 5.75918 135.46 2.58552C136.12 1.52763 136.978 0.535855 138.365 0.866446C139.554 1.13092 140.478 2.67761 140.478 2.67761C141.419 3.80397 142.261 6.20785 142.855 8.38974C143.515 10.9022 143.845 13.547 143.977 16.1917C143.977 16.39 143.977 16.5223 143.911 16.6545C147.939 19.4315 150.976 22.6051 152.693 23.9275C153.419 24.5226 161.475 30.0765 149.656 30.6054C154.081 31.2005 168.633 41.9752 147.174 38.3387C147.439 39.3305 159.098 48.9862 138.035 48.3912C136.714 48.3251 102.842 54.4079 94.7206 34.4403L98.4842 33.9113C99.8048 33.713 100.729 32.5228 100.597 31.2005Z"
                                    fill="#DADCE0"></path>
                                <path
                                    d="M100.093 27.7061L100.598 31.1345C100.796 32.4569 99.8054 33.7131 98.4849 33.9115L94.8262 34.7447C93.9678 32.6289 93.4239 31.607 93.2258 28.8962L100.093 27.7061Z"
                                    fill="#5F6368"></path>
                                <path
                                    d="M117.954 72.957C118.05 80.1039 118.002 87.1851 117.761 94.332C110.28 95.279 109.241 100.203 109 102.957"
                                    stroke="#5F6368" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M118.04 99.4629C116.18 99.8045 114.688 102.179 114.505 103.087"
                                    stroke="#5F6368" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M104 98.957C102.084 99.619 101 102.087 101 102.957" stroke="#5F6368"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M121.145 27.8622C120.581 27.9058 120.088 27.483 120.045 26.9178C120.001 26.3526 120.423 25.859 120.987 25.8154C121.551 25.7717 122.044 26.1945 122.088 26.7597C122.132 27.3249 121.71 27.8185 121.145 27.8622Z"
                                    fill="#5F6368"></path>
                                <path
                                    d="M109.598 26.6512C109.033 26.6949 108.541 26.272 108.497 25.7068C108.453 25.1416 108.875 24.6481 109.439 24.6044C110.004 24.5608 110.496 24.9836 110.54 25.5488C110.584 26.114 110.162 26.6076 109.598 26.6512Z"
                                    fill="#5F6368"></path>
                                <path d="M141.516 38.3389C143.043 39.0428 146.545 40.2635 148.328 39.5154"
                                    stroke="#5F6368" stroke-width="2" stroke-linecap="round"></path>
                                <path d="M135.566 39.291C136.151 40.1914 138.081 42.1456 141.131 42.7594"
                                    stroke="#5F6368" stroke-width="2" stroke-linecap="round"></path>
                                <path d="M41 102H70V88H41C45.1938 92.1674 45.1938 97.8326 41 102Z" fill="#5F6368">
                                </path>
                                <path
                                    d="M13.2949 88H39C34.3263 83.9628 34.2329 78.2326 38.8131 74.1953L39 74H13.2949C8.90169 78.1674 8.90169 83.7674 13.2949 88Z"
                                    fill="#DADCE0"></path>
                                <path d="M32 81H79" stroke="#DADCE0" stroke-width="2" stroke-linecap="round">
                                </path>
                                <path d="M32 87H79" stroke="#DADCE0" stroke-width="2" stroke-linecap="round">
                                </path>
                                <path d="M1 95H63" stroke="#5F6368" stroke-width="2" stroke-linecap="round">
                                </path>
                                <path d="M1 101H63" stroke="#5F6368" stroke-width="2" stroke-linecap="round">
                                </path>
                                <path d="M32 75H79" stroke="#DADCE0" stroke-width="2" stroke-linecap="round">
                                </path>
                                <path d="M1 89H63" stroke="#5F6368" stroke-width="2" stroke-linecap="round">
                                </path>
                                <path
                                    d="M7.28938 67.951C5.41313 67.951 3.88867 67.951 3.88867 64.5502V24.8558C3.88867 22.9795 5.41313 21.4551 7.28938 21.4551H69.0352C70.9114 21.4551 72.4359 22.9795 72.4359 24.8558L7.28938 67.951Z"
                                    fill="#CEEAD6" class="VnOHwf-Ysl7Fe"></path>
                                <path
                                    d="M4.07143 68.1345H68.3043C70.2392 68.1345 71.8223 66.5515 71.8223 64.6166V25.1566C71.8223 23.2218 70.2392 21.6387 68.3043 21.6387L7.5894 21.6387C5.65452 21.6387 4.07143 23.2218 4.07143 25.1566V68.1345Z"
                                    stroke="#5F6368" stroke-width="2" stroke-miterlimit="10"></path>
                                <path
                                    d="M92.7904 68.2686H3V74.4081H92.7904C94.4858 74.4081 95.8602 73.0337 95.8602 71.3383C95.8602 69.6429 94.4858 68.2686 92.7904 68.2686Z"
                                    fill="#5F6368"></path>
                                <path d="M112 7.95703L114 13.957" stroke="#5F6368" stroke-width="2"
                                    stroke-linecap="round"></path>
                                <path d="M137 6.95703L138 12.957" stroke="#5F6368" stroke-width="2"
                                    stroke-linecap="round"></path>
                                <path
                                    d="M118.487 39.8768C117.746 47.6332 116.034 62.1001 116.034 62.1001L96.1434 60.2671C98.2227 53.5399 100.102 47.8608 102.369 39.8768L118.487 39.8768Z"
                                    fill="#5F6368"></path>
                                <path
                                    d="M115.955 41.1963C115.14 44.4072 113.625 49.7609 112.234 54.5774C111.442 57.3212 110.693 59.8815 110.142 61.7561C109.873 62.6705 109.651 63.4217 109.495 63.9512L91.895 60.6012C92.6965 58.5653 93.489 56.6018 94.2883 54.6217C95.9565 50.4888 97.6539 46.2836 99.5233 41.1962L115.955 41.1963Z"
                                    fill="white" stroke="#5F6368" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M108.418 42.9432C100.744 43.7107 97.9015 39.7526 97.9015 39.7526L117.628 39.7526C117.628 39.7526 116.093 42.1758 108.418 42.9432Z"
                                    fill="#DADCE0"></path>
                                <path d="M119.279 33.8346C118.111 35.2699 115.428 40.2128 121.11 43.8439"
                                    stroke="#5F6368" stroke-width="2" stroke-linecap="round"></path>
                                <path d="M98 36.957H115V40.957L98 40.557V36.957Z" fill="#DADCE0"></path>
                                <path d="M99.1969 41.8728C102.843 43.7476 111.606 45.8632 117.496 39.3267"
                                    stroke="#5F6368" stroke-width="2" stroke-linecap="round"></path>
                            </svg>
                            <span>This is where you'll assign work</span>
                            <p>You can add assignments and other work for the class, then organise it into topics</p>
                        </span>
                    </div>
                @endif
            </div>
        </section>
    </div>

    <div id="classwork-container-change"></div>
    {{-- <x-classwork-type :classroom="$classroom" :students="$students" :classrooms="$classrooms" :topics="$topics" /> --}}
    <x-topic-structure id="create-topic" title="Add topic" input-label="Topic" input-id="classroom"
        input-name="name" button='Add' route="{{ route('topic.store', $classroom->code) }}" />
    <x-topic-structure form-id='form-rename-topic' id="rename-topic" title="Rename topic" input-label="Topic"
        input-id="topic-rename" input-name="name" button="Rename" route='' method='put' />
    <x-classwork-add-links form-id='add-links' id="classwork-link" title="Add link" input-label="Link"
        input-id="input-classwork-link" input-name="link" button="Add link" route="" />
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script>
    function sendSubmisstion(e,isStudent) {
        if(isStudent) {
            let a = document.createElement('a');
            a.href = e.dataset.link;
            a.click();
        }
    }
        buttonMaterialOptions = document.querySelectorAll('div.button-material-options');
        materialOptions = document.querySelectorAll('ul.material-options');
        buttonMaterialOptions.forEach((ele, i) => {
            ele.onclick = function() {
                materialOptions.forEach((element, index) => {
                    if (i != index) {
                        element.classList.add('hidden');
                    }
                });
                materialOptions[i].classList.toggle('hidden');
                document.querySelectorAll('.classwork-section .rigth-side ul.content > li')[i].classList.add(
                    'active')
                document.querySelectorAll(
                        '.classwork-section .rigth-side ul.content > li + .classwork-information'
                    )[i].classList
                    .add('active');
            }
        });
        buttonTopicOptions = document.querySelectorAll('div.button-topic-options');
        TopicOptions = document.querySelectorAll('ul.topic-options');
        buttonTopicOptions.forEach((ele, i) => {
            ele.onclick = function() {
                TopicOptions.forEach((element, index) => {
                    if (i != index) {
                        element.classList.add('hidden');
                    }
                });
                TopicOptions[i].classList.toggle('hidden');
            }
        });
    </script>
    <x-slot:script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.27.2/dist/editorjs.umd.min.js"></script>

        <script>
            function display() {

                document.getElementById('number-of-points-for-classwork').oninput = function() {
                    this.classList.add('active');
                    if (this.value.toLowerCase() != 'unmarked') {
                        document.querySelector('#number-of-points-for-classwork + ul').classList.remove('remove');
                    } else {
                        document.querySelector('#number-of-points-for-classwork + ul').classList.add('remove');
                    }

                }
                document.querySelector('#number-of-points-for-classwork').onclick = function() {
                    if (this.value.toLowerCase() != 'unmarked') {
                        document.querySelector('#number-of-points-for-classwork + ul').classList.remove('remove');
                    }
                }
                document.querySelector('#number-of-points-for-classwork').onblur = function() {
                    document.querySelector('#number-of-points-for-classwork + ul').classList.add('remove');
                    if (isNaN(parseInt(this.value))) {
                        this.value = 'unmarked';
                    }
                }

                let students_checkbox = document.querySelectorAll('#select-students-in-classwork li')
                document.querySelectorAll('#select-students-in-classwork li input').forEach((e, i) => {
                    e.onchange = function() {
                        checkStudentsCheckbox();
                    }
                })
                checkStudentsCheckbox();

                function checkStudentsCheckbox() {
                    number = 0;
                    document.querySelectorAll('#select-students-in-classwork li input').forEach((e, i) => {
                        if (e.checked) {
                            students_checkbox[i].classList.add('active');
                            number++;
                        } else {
                            students_checkbox[i].classList.remove('active');
                        }
                    });
                    if (number == document.querySelectorAll('#select-students-in-classwork li input').length) {
                        document.querySelectorAll('#select-students-in-classwork li input').forEach((e, i) => {
                            students_checkbox[i].classList.remove('active');
                        });
                        document.querySelectorAll('#select-students-in-classwork li input')[0].disabled = true;
                        students_checkbox[0].classList.add('active');
                    } else {
                        document.querySelectorAll('#select-students-in-classwork li input')[0].disabled = false;
                        document.querySelectorAll('#select-students-in-classwork li input')[0].checked = false;
                        students_checkbox[0].classList.remove('active');
                    }
                }
                let classrooms_checkbox = document.querySelectorAll('#select-classroom-in-classwork li')
                document.querySelectorAll('#select-classroom-in-classwork li input').forEach((e, i) => {
                    e.onchange = function() {
                        if (e.checked) {
                            classrooms_checkbox[i].classList.add('active');
                        } else {
                            classrooms_checkbox[i].classList.remove('active');
                        }
                    }
                })

                if (!document.getElementById('classwork_type').classList.contains('remove')) {
                    document.body.style.overflow = 'hidden';
                }
                document.getElementById('classwork_title').onblur = function() {
                    if (this.value != '') {
                        document.getElementById('send_classwork').classList.add('active');
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


            }

            document.getElementById('create-classwork-assignment').onclick = function() {
                document.body.style.overflow = 'hidden';
                console.log('hi');

            }

            function createAssigment(e) {
                document.body.style.overflow = 'hidden';
                document.getElementById('classwork-container-change').innerHTML = `
                <x-classwork-type :classroom="$classroom" :students="$students" :classrooms="$classrooms" :topics="$topics" />
                `;
                display();
                document.getElementById('classwork_type').classList.remove('remove');
                e.parentNode.classList.add('hidden');
                document.getElementById('classwork_input_type').value = `{{ \App\Enums\ClassworkType::ASSIGNMENT }}`;
            }

            function createQuestion(e) {
                document.body.style.overflow = 'hidden';
                document.getElementById('classwork-container-change').innerHTML = `
                <x-classwork-type :classroom="$classroom" :students="$students" :classrooms="$classrooms" :topics="$topics" type='Question' />
                `;
                display();
                document.getElementById('classwork_type').classList.remove('remove');
                e.parentNode.classList.add('hidden');
                document.getElementById('classwork_input_type').value = `{{ \App\Enums\ClassworkType::QUESTION }}`;
            }

            function createMaterial(e) {
                document.body.style.overflow = 'hidden';
                document.getElementById('classwork-container-change').innerHTML = `
                <x-classwork-type :classroom="$classroom" :students="$students" :classrooms="$classrooms" :topics="$topics" type='Material' />
                `;
                display();
                document.getElementById('classwork_type').classList.remove('remove');
                e.parentNode.classList.add('hidden');
                document.getElementById('classwork_input_type').value = `{{ \App\Enums\ClassworkType::MATERIAL }}`;
            }


            function showClassworkInfo() {
                document.querySelectorAll('.classwork-section .rigth-side ul.content > li').forEach((e, i) => {
                    e.onclick = function() {
                        console.log('hi');
                        this.classList.toggle('active');
                        document.querySelectorAll(
                                '.classwork-section .rigth-side ul.content > li + .classwork-information')[i]
                            .classList
                            .toggle('active');
                    }
                });
            }
            showClassworkInfo();

            function classworkEdit(classwork, parent, element) {
                element.parentNode.classList.add('hidden');
                setTimeout(() => {
                    parent.classList.remove('active');
                }, 0);
                document.getElementById('classwork-container-change').innerHTML = `
                <x-classwork-type :classroom="$classroom" :students="$students" :classrooms="$classrooms" :topics="$topics" />
                `;
                document.querySelector('input#classwork_title').value = classwork.title;
                document.querySelector('input#number-of-points-for-classwork').value = classwork.points == undefined ?
                    'unmarked' : classwork.points;
                display();
                [...document.getElementById('select-classwork-topic').children].forEach(e => {
                    if (e.value == element.dataset.topic) {
                        e.selected = true;
                    }
                })
            }
        </script>

    </x-slot:script>
</x-layout>
